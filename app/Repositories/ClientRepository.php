<?php

namespace App\Repositories;

use App\Models\Client;


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

}