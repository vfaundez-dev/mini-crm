<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use \Illuminate\Support\Collection;

class ClientRepository {

  public function all(): Collection {
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

  public function allOwnerFiltered($ownerId = null): Collection {
    if (!User::where('id', $ownerId)->exists()) {
      return collect(); // Return empty collect if owner does not exist
    }
    return Client::where('owner_id', $ownerId)->get();
  }

  public function clientStatus(): Collection {
    return \App\Models\ClientStatus::all();
  }

  public function clientType(): Collection {
    return \App\Models\ClientType::all();
  }

  public function clientIndustry(): Collection {
    return \App\Models\ClientIndustry::all();
  }

}