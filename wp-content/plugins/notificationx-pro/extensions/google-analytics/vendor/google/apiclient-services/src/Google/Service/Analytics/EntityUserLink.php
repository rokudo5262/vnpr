<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class NxPro_Google_Service_Analytics_EntityUserLink extends NxPro_Google_Model
{
  protected $entityType = 'NxPro_Google_Service_Analytics_EntityUserLinkEntity';
  protected $entityDataType = '';
  public $id;
  public $kind;
  protected $permissionsType = 'NxPro_Google_Service_Analytics_EntityUserLinkPermissions';
  protected $permissionsDataType = '';
  public $selfLink;
  protected $userRefType = 'NxPro_Google_Service_Analytics_UserRef';
  protected $userRefDataType = '';

  /**
   * @param NxPro_Google_Service_Analytics_EntityUserLinkEntity
   */
  public function setEntity(NxPro_Google_Service_Analytics_EntityUserLinkEntity $entity)
  {
    $this->entity = $entity;
  }
  /**
   * @return NxPro_Google_Service_Analytics_EntityUserLinkEntity
   */
  public function getEntity()
  {
    return $this->entity;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param NxPro_Google_Service_Analytics_EntityUserLinkPermissions
   */
  public function setPermissions(NxPro_Google_Service_Analytics_EntityUserLinkPermissions $permissions)
  {
    $this->permissions = $permissions;
  }
  /**
   * @return NxPro_Google_Service_Analytics_EntityUserLinkPermissions
   */
  public function getPermissions()
  {
    return $this->permissions;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
  /**
   * @param NxPro_Google_Service_Analytics_UserRef
   */
  public function setUserRef(NxPro_Google_Service_Analytics_UserRef $userRef)
  {
    $this->userRef = $userRef;
  }
  /**
   * @return NxPro_Google_Service_Analytics_UserRef
   */
  public function getUserRef()
  {
    return $this->userRef;
  }
}
