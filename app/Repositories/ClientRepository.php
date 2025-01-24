<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;

class ClientRepository {

  public function all() {
    return Client::all();
  }

  public function find(string $id): ?Client {
    return Client::find($id);
  }

  public function create(array $data): Client {
    return Client::create($data);
  }

  public function update(Client $client, array $data): bool {
    return Client::find($client->id)->update($data);
  }

  public function delete(Client $client): bool {
    return Client::find($client->id)->delete();
  }

  public function allOwnerFiltered($ownerId = null) {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Client::where('is_active', 1)->where('owner_id', $ownerId)->get();
  }

  public function clientStatus() {
    return \App\Models\ClientStatus::all();
  }

  public function clientType() {
    return \App\Models\ClientType::all();
  }

  public function clientIndustry() {
    return \App\Models\ClientIndustry::all();
  }

}