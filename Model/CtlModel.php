<?php

class CtlModel extends AppModel
{
    var $name = 'CtlModel';
    var $useTable = false;

  /**
   * find issues_by_assigned_to
   *
   * @param  integer $projectId
   * @return mixed
   */
  function findIIssuesByAssignedTo($projectId)
  {
    $issue =& ClassRegistry::init('Issue');
    $issueStatus =& ClassRegistry::init('IssueStatus');
    $user =& ClassRegistry::init('User');

    $sql = <<<EOT
select s.id as status_id,
  s.is_closed as closed,
  a.id as assigned_to_id,
  count(i.id) as total,
  sum(i.done_ratio) as done
from
  {$issue->useTable} i, {$issueStatus->useTable} s, {$user->useTable} a
where
  i.status_id=s.id
  and i.assigned_to_id=a.id
  and i.project_id={$projectId}
group by s.id, s.is_closed, a.id
EOT;

    return $this->convFlatArray($this->query($sql));
  }

  /**
   * 
   * @param  array $data
   * @return mixed
   */
  function convFlatArray($data)
  {
    $ret = array();
    foreach ($data as $v) {
      $tmp = array();
      foreach ($v as $k1 => $v1) {
        if (is_array($v1)) {
          foreach ($v1 as $k2 => $v2) {
            $tmp[$k2] = $v2;
          }
        } else {
          $tmp[$k1] = $v1;
        }
      }
      $ret[] = $tmp;
    }

    return $ret;
  }
}
