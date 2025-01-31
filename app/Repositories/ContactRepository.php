<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;
use \Illuminate\Support\Collection;

class ContactRepository {

  public function all(): Collection {
    return Contact::all();
  }

  public function find(string $id): ?Contact {
    return Contact::find($id);
  }

  public function create(array $data): Contact {
    return Contact::create($data);
  }

  public function update(Contact $contact, array $data): bool {
    return Contact::find($contact->id)->update($data);
  }

  public function delete(Contact $contact): bool {
    return Contact::find($contact->id)->delete();
  }

  public function fullName(string $first_name, string $last_name): string {
    return trim($first_name . ' ' . $last_name);
  }

  public function allOwnerFiltered($ownerId = null): Collection {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Contact::where('owner_id', $ownerId)->get();
  }

  public function contactJobTitles(): Collection {
    return \App\Models\ContactJobTitle::all();
  }

  public function contactDepartments(): Collection {
    return \App\Models\ContactDepartment::all();
  }

}