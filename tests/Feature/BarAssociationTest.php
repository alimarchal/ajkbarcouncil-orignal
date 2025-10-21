<?php

use App\Models\User;
use App\Models\BarAssociation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

$user = null;

beforeEach(function () {
    global $user;
    $user = User::factory()->create();
});

describe('Bar Association Index', function () {
    test('can view bar associations index page', function () {
        global $user;
        $this->actingAs($user)
            ->get(route('bar-associations.index'))
            ->assertStatus(200)
            ->assertViewIs('bar-associations.index')
            ->assertViewHas('barAssociations');
    });

    test('can filter bar associations by name', function () {
        global $user;
        BarAssociation::factory()->create(['name' => 'Test Bar Association']);
        BarAssociation::factory()->create(['name' => 'Another Association']);

        $response = $this->actingAs($user)
            ->get(route('bar-associations.index', ['filter' => ['name' => 'Test']]));

        $response->assertStatus(200);
        expect($response['barAssociations']->count())->toBe(1);
    });

    test('shows only active records by default', function () {
        global $user;
        BarAssociation::factory(2)->create(['is_active' => true]);
        BarAssociation::factory(1)->create(['is_active' => false]);

        $response = $this->actingAs($user)->get(route('bar-associations.index'));

        $response->assertStatus(200);
        expect($response['barAssociations']->count())->toBe(2);
    });
});

describe('Bar Association Create', function () {
    test('can view create page', function () {
        global $user;
        $this->actingAs($user)
            ->get(route('bar-associations.create'))
            ->assertStatus(200)
            ->assertViewIs('bar-associations.create');
    });

    test('can create bar association with valid data', function () {
        global $user;
        $response = $this->actingAs($user)
            ->post(route('bar-associations.store'), [
                'name' => 'New Bar Association',
                'is_active' => true,
            ]);

        $response->assertRedirect(route('bar-associations.index'))
            ->assertSessionHas('success');

        expect(BarAssociation::where('name', 'New Bar Association')->first())
            ->not()->toBeNull();
    });

    test('cannot create bar association with duplicate name', function () {
        global $user;
        BarAssociation::factory()->create(['name' => 'Duplicate Name']);

        $response = $this->actingAs($user)
            ->post(route('bar-associations.store'), [
                'name' => 'Duplicate Name',
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors('name');
    });

    test('cannot create bar association without name', function () {
        global $user;
        $response = $this->actingAs($user)
            ->post(route('bar-associations.store'), [
                'name' => '',
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors('name');
    });

    test('created_by is automatically set to current user', function () {
        global $user;
        $this->actingAs($user)
            ->post(route('bar-associations.store'), [
                'name' => 'Test Association',
                'is_active' => true,
            ]);

        $barAssociation = BarAssociation::where('name', 'Test Association')->first();
        expect($barAssociation->created_by)->toBe($user->id);
    });
});

describe('Bar Association Show', function () {
    test('can view bar association details', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $this->actingAs($user)
            ->get(route('bar-associations.show', $barAssociation))
            ->assertStatus(200)
            ->assertViewIs('bar-associations.show');
    });
});

describe('Bar Association Edit', function () {
    test('can view edit page', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $this->actingAs($user)
            ->get(route('bar-associations.edit', $barAssociation))
            ->assertStatus(200)
            ->assertViewIs('bar-associations.edit');
    });

    test('can update bar association with valid data', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create(['name' => 'Original']);

        $response = $this->actingAs($user)
            ->put(route('bar-associations.update', $barAssociation), [
                'name' => 'Updated Name',
                'is_active' => false,
            ]);

        $response->assertRedirect(route('bar-associations.index'))
            ->assertSessionHas('success');

        $barAssociation->refresh();
        expect($barAssociation->name)->toBe('Updated Name');
        expect($barAssociation->is_active)->toBeFalse();
    });

    test('cannot update bar association with duplicate name', function () {
        global $user;
        $first = BarAssociation::factory()->create(['name' => 'First']);
        $second = BarAssociation::factory()->create(['name' => 'Second']);

        $response = $this->actingAs($user)
            ->put(route('bar-associations.update', $second), [
                'name' => 'First',
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors('name');
    });

    test('updated_by is set to current user on update', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $this->actingAs($user)
            ->put(route('bar-associations.update', $barAssociation), [
                'name' => 'Updated Name',
                'is_active' => true,
            ]);

        $barAssociation->refresh();
        expect($barAssociation->updated_by)->toBe($user->id);
    });
});

describe('Bar Association Delete', function () {
    test('can soft delete bar association', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('bar-associations.destroy', $barAssociation));

        $response->assertRedirect(route('bar-associations.index'))
            ->assertSessionHas('success');

        expect($barAssociation->fresh()->trashed())->toBeTrue();
    });

    test('deleted bar association is not shown in index by default', function () {
        global $user;
        $active = BarAssociation::factory()->create(['name' => 'Active']);
        $deleted = BarAssociation::factory()->create(['name' => 'Deleted']);
        $deleted->delete();

        $response = $this->actingAs($user)
            ->get(route('bar-associations.index'));

        $names = $response['barAssociations']->pluck('name')->toArray();
        expect(in_array('Deleted', $names))->toBeFalse();
        expect(in_array('Active', $names))->toBeTrue();
    });
});

describe('Bar Association Restore', function () {
    test('can restore deleted bar association', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $barAssociation->delete();

        $response = $this->actingAs($user)
            ->patch(route('bar-associations.restore', $barAssociation->id));

        $response->assertRedirect(route('bar-associations.index'))
            ->assertSessionHas('success');

        expect($barAssociation->fresh()->trashed())->toBeFalse();
    });

    test('restored bar association appears in index', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create(['name' => 'Restored']);
        $barAssociation->delete();

        $this->actingAs($user)
            ->patch(route('bar-associations.restore', $barAssociation->id));

        $response = $this->actingAs($user)
            ->get(route('bar-associations.index'));

        $names = $response['barAssociations']->pluck('name')->toArray();
        expect(in_array('Restored', $names))->toBeTrue();
    });
});

describe('Bar Association Authorization', function () {
    test('unauthenticated user cannot access index', function () {
        $this->get(route('bar-associations.index'))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot create', function () {
        $this->get(route('bar-associations.create'))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot store', function () {
        $this->post(route('bar-associations.store'), [
            'name' => 'Test',
            'is_active' => true,
        ])->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot view', function () {
        $barAssociation = BarAssociation::factory()->create();

        $this->get(route('bar-associations.show', $barAssociation))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot delete', function () {
        $barAssociation = BarAssociation::factory()->create();

        $this->delete(route('bar-associations.destroy', $barAssociation))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot restore', function () {
        $barAssociation = BarAssociation::factory()->create();
        $barAssociation->delete();

        $this->patch(route('bar-associations.restore', $barAssociation->id))
            ->assertRedirect(route('login'));
    });
});
