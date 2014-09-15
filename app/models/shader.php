<?php

class shader {
  function create($data = array()) {
    $shader = R::dispense('shaders');
    $shader['name'] = $data['name'];
    $shader['rarity'] = $data['rarity'];
    $shader['source'] = $data['source'];
    $s_id = R::store($shader);
  }
}