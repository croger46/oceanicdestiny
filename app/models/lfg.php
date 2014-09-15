<?php
/**
 * Class: lfg
 *
 * handles all public (unsigned) LFG requests
 * @author Johnathan Tiong <johnathan.tiong@gmail.com>
 * @version v1.0.2014.09.06
 * @since  v1.0.2014.09.04
 */

class lfg {
  /**
   * creates the LFG request as a record in the lfg table
   * @param array $data the _POST data from the creation request
   * @return bool true/false on creation
   */
  function create($data = array()) {
    $lfg             = R::dispense('lfg');
    $lfg['level']    = $data['level'];
    $lfg['class']    = $data['class'];
    $lfg['type']     = $data['type'];
    $lfg['activity'] = $data['activity'];
    $lfg['mode']     = $data['mode'];
    $lfg['headset']  = $data['headset'];
    $lfg['gamerid']  = $data['gamerid'];
    $lfg['platform'] = $data['platform'];
    $lfg['note']     = $data['note'];
    $lfgID           = R::store($lfg);

    if($lfg != null) return true;

    return false;
  }

  /**
   * disables an LFG request
   * @param int $id id number of the LFG request to disable
   * @return bool true/false on disable result
   */
  function disable($id) {
    $lfg = R::load('lfg', $id);
    $lfg['enabled'] = 0;
    R::store($lfg);

    $lfgCheck = R::load('lfg', $id);

    if($lfgCheck['enabled'] == 0) {
      return true;
    }

    return false;
  }

  /**
   * deletes an LFG request PERMANENTLY (dangerous!)
   * @param  int $id id number of the LFG ntoice that is to be deleted
   */
  function delete($id) {
    $lfg = R::load('lfg', $id);
    R::trash($lfg);
  }

  /**
   * gets all LFG notices 
   * @return [type] [description]
   */
  function getLFG() {
    $lfg_data = R::find('lfg', ' enabled = 1 ORDER BY created DESC');
    return $lfg_data;
  }
}