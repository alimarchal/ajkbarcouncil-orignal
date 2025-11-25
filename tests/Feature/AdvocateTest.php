<?php

use App\Models\User;
use App\Models\Advocate;
use App\Models\BarAssociation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

$user = null;

beforeEach(function () {
    global $user;
    $user = User::factory()->create();
});

describe('Advocate Index', function () {
    test('can view advocates index page', function () {
        global $user;
        $this->actingAs($user)
            ->get(route('advocates.index'))
            ->assertStatus(200)
            ->assertViewIs('advocates.index')
            ->assertViewHas('advocates');
    });

    test('can filter advocates by name', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Ahmed Ali Khan'
        ]);
        Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Muhammad Hassan'
        ]);

        $response = $this->actingAs($user)
            ->get(route('advocates.index', ['filter' => ['name' => 'Ahmed']]));

        $response->assertStatus(200);
        expect($response['advocates']->count())->toBe(1);
    });

    test('can filter advocates by email', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'test@example.com'
        ]);
        Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'other@example.com'
        ]);

        $response = $this->actingAs($user)
            ->get(route('advocates.index', ['filter' => ['email_address' => 'test']]));

        $response->assertStatus(200);
        expect($response['advocates']->count())->toBe(1);
    });

    test('shows only active records by default', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        Advocate::factory(2)->create([
            'bar_association_id' => $barAssociation->id,
            'is_active' => true
        ]);
        Advocate::factory(1)->create([
            'bar_association_id' => $barAssociation->id,
            'is_active' => false
        ]);

        $response = $this->actingAs($user)->get(route('advocates.index'));

        $response->assertStatus(200);
        expect($response['advocates']->count())->toBe(2);
    });

    test('can filter by bar association', function () {
        global $user;
        $bar1 = BarAssociation::factory()->create(['name' => 'Bar 1']);
        $bar2 = BarAssociation::factory()->create(['name' => 'Bar 2']);
        Advocate::factory()->create(['bar_association_id' => $bar1->id]);
        Advocate::factory()->create(['bar_association_id' => $bar2->id]);

        $response = $this->actingAs($user)
            ->get(route('advocates.index', ['filter' => ['bar_association_id' => $bar1->id]]));

        $response->assertStatus(200);
        expect($response['advocates']->count())->toBe(1);
    });

    test('can view deleted advocates with show_deleted filter', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $active = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);
        $deleted = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);
        $deleted->delete();

        $response = $this->actingAs($user)
            ->get(route('advocates.index', ['filter' => ['show_deleted' => '1']]));

        $response->assertStatus(200);
        expect($response['advocates']->count())->toBe(1);
    });
});

describe('Advocate Create', function () {
    test('can view create page with bar associations', function () {
        global $user;
        BarAssociation::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('advocates.create'));

        $response->assertStatus(200)
            ->assertViewIs('advocates.create')
            ->assertViewHas('barAssociations');
    });

    test('can create advocate with valid data', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('advocates.store'), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Ahmed Ali Khan',
                'father_husband_name' => 'Muhammad Khan',
                'email_address' => 'ahmed@example.com',
                'mobile_no' => '03001234567',
                'complete_address' => 'Karachi, Pakistan',
                'is_active' => true,
            ]);

        $response->assertRedirect(route('advocates.index'))
            ->assertSessionHas('success');

        expect(Advocate::where('name', 'Ahmed Ali Khan')->first())
            ->not()->toBeNull();
    });

    test('cannot create advocate with duplicate email', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'test@example.com'
        ]);

        $response = $this->actingAs($user)
            ->post(route('advocates.store'), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Another Advocate',
                'father_husband_name' => 'Father Name',
                'email_address' => 'test@example.com',
                'mobile_no' => '03001234567',
                'complete_address' => 'Address',
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors('email_address');
    });

    test('cannot create advocate without required fields', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('advocates.store'), [
                'bar_association_id' => $barAssociation->id,
                'name' => '',
                'father_husband_name' => '',
                'email_address' => '',
                'mobile_no' => '',
                'complete_address' => '',
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors(['name', 'father_husband_name', 'email_address', 'mobile_no', 'complete_address']);
    });

    test('created_by is automatically set to current user', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $this->actingAs($user)
            ->post(route('advocates.store'), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Test Advocate',
                'father_husband_name' => 'Father',
                'email_address' => 'advocate@example.com',
                'mobile_no' => '03001234567',
                'complete_address' => 'Address',
                'is_active' => true,
            ]);

        $advocate = Advocate::where('name', 'Test Advocate')->first();
        expect($advocate->created_by)->toBe($user->id);
    });

    test('can create advocate with optional fields', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('advocates.store'), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Advanced Advocate',
                'father_husband_name' => 'Father Name',
                'email_address' => 'advanced@example.com',
                'mobile_no' => '03001234567',
                'complete_address' => 'Complete Address',
                'is_active' => true,
                'date_of_enrolment_lower_courts' => '2015-01-15',
                'date_of_enrolment_high_court' => '2018-06-20',
                'date_of_enrolment_supreme_court' => '2020-09-10',
                'duration_of_practice' => 2015,
            ]);

        $response->assertRedirect(route('advocates.index'));
        $advocate = Advocate::where('name', 'Advanced Advocate')->first();
        expect($advocate->date_of_enrolment_lower_courts)->not()->toBeNull();
        expect($advocate->duration_of_practice)->not()->toBeNull();
    });
});

describe('Advocate Show', function () {
    test('can view advocate details', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);

        $this->actingAs($user)
            ->get(route('advocates.show', $advocate))
            ->assertStatus(200)
            ->assertViewIs('advocates.show')
            ->assertViewHas('advocate');
    });

    test('advocate details page shows all information', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Test Advocate',
            'email_address' => 'test@example.com',
            'mobile_no' => '03001234567',
        ]);

        $response = $this->actingAs($user)
            ->get(route('advocates.show', $advocate));

        $response->assertSee('Test Advocate')
            ->assertSee('test@example.com')
            ->assertSee('03001234567');
    });
});

describe('Advocate Edit', function () {
    test('can view edit page', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);

        $response = $this->actingAs($user)
            ->get(route('advocates.edit', $advocate));

        $response->assertStatus(200)
            ->assertViewIs('advocates.edit')
            ->assertViewHas('advocate')
            ->assertViewHas('barAssociations');
    });

    test('can update advocate with valid data', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Original Name'
        ]);

        $response = $this->actingAs($user)
            ->put(route('advocates.update', $advocate), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Updated Name',
                'father_husband_name' => $advocate->father_husband_name,
                'email_address' => $advocate->email_address,
                'mobile_no' => $advocate->mobile_no,
                'complete_address' => $advocate->complete_address,
                'is_active' => false,
            ]);

        $response->assertRedirect(route('advocates.index'))
            ->assertSessionHas('success');

        $advocate->refresh();
        expect($advocate->name)->toBe('Updated Name');
        expect($advocate->is_active)->toBeFalse();
    });

    test('cannot update advocate with duplicate email', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate1 = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'first@example.com'
        ]);
        $advocate2 = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'second@example.com'
        ]);

        $response = $this->actingAs($user)
            ->put(route('advocates.update', $advocate2), [
                'bar_association_id' => $barAssociation->id,
                'name' => $advocate2->name,
                'father_husband_name' => $advocate2->father_husband_name,
                'email_address' => 'first@example.com',
                'mobile_no' => $advocate2->mobile_no,
                'complete_address' => $advocate2->complete_address,
                'is_active' => true,
            ]);

        $response->assertSessionHasErrors('email_address');
    });

    test('updated_by is set to current user on update', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Original'
        ]);

        $this->actingAs($user)
            ->put(route('advocates.update', $advocate), [
                'bar_association_id' => $barAssociation->id,
                'name' => 'Updated',
                'father_husband_name' => $advocate->father_husband_name,
                'email_address' => $advocate->email_address,
                'mobile_no' => $advocate->mobile_no,
                'complete_address' => $advocate->complete_address,
                'is_active' => true,
            ]);

        $advocate->refresh();
        expect($advocate->updated_by)->toBe($user->id);
    });

    test('can update email when it remains the same', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'email_address' => 'test@example.com'
        ]);

        $response = $this->actingAs($user)
            ->put(route('advocates.update', $advocate), [
                'bar_association_id' => $barAssociation->id,
                'name' => $advocate->name,
                'father_husband_name' => 'Updated Father',
                'email_address' => 'test@example.com',
                'mobile_no' => $advocate->mobile_no,
                'complete_address' => $advocate->complete_address,
                'is_active' => true,
            ]);

        $response->assertRedirect(route('advocates.index'));
    });
});

describe('Advocate Delete', function () {
    test('can soft delete advocate', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);

        $response = $this->actingAs($user)
            ->delete(route('advocates.destroy', $advocate));

        $response->assertRedirect(route('advocates.index'))
            ->assertSessionHas('success');

        expect($advocate->fresh()->trashed())->toBeTrue();
    });

    test('deleted advocate is not shown in index by default', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $active = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Active Advocate'
        ]);
        $deleted = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Deleted Advocate'
        ]);
        $deleted->delete();

        $response = $this->actingAs($user)
            ->get(route('advocates.index'));

        $names = $response['advocates']->pluck('name')->toArray();
        expect(in_array('Deleted Advocate', $names))->toBeFalse();
        expect(in_array('Active Advocate', $names))->toBeTrue();
    });
});

describe('Advocate Restore', function () {
    test('can restore deleted advocate', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);
        $advocate->delete();

        $response = $this->actingAs($user)
            ->patch(route('advocates.restore', $advocate->id));

        $response->assertRedirect(route('advocates.index'))
            ->assertSessionHas('success');

        expect($advocate->fresh()->trashed())->toBeFalse();
    });

    test('restored advocate appears in index', function () {
        global $user;
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create([
            'bar_association_id' => $barAssociation->id,
            'name' => 'Restored Advocate'
        ]);
        $advocate->delete();

        $this->actingAs($user)
            ->patch(route('advocates.restore', $advocate->id));

        $response = $this->actingAs($user)
            ->get(route('advocates.index'));

        $names = $response['advocates']->pluck('name')->toArray();
        expect(in_array('Restored Advocate', $names))->toBeTrue();
    });
});

describe('Advocate Authorization', function () {
    test('unauthenticated user cannot access index', function () {
        $this->get(route('advocates.index'))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot create', function () {
        $this->get(route('advocates.create'))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot store', function () {
        $barAssociation = BarAssociation::factory()->create();

        $this->post(route('advocates.store'), [
            'bar_association_id' => $barAssociation->id,
            'name' => 'Test',
            'father_husband_name' => 'Test',
            'email_address' => 'test@example.com',
            'mobile_no' => '03001234567',
            'complete_address' => 'Address',
            'is_active' => true,
        ])->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot view', function () {
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);

        $this->get(route('advocates.show', $advocate))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot delete', function () {
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);

        $this->delete(route('advocates.destroy', $advocate))
            ->assertRedirect(route('login'));
    });

    test('unauthenticated user cannot restore', function () {
        $barAssociation = BarAssociation::factory()->create();
        $advocate = Advocate::factory()->create(['bar_association_id' => $barAssociation->id]);
        $advocate->delete();

        $this->patch(route('advocates.restore', $advocate->id))
            ->assertRedirect(route('login'));
    });
});
