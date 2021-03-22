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

class NxPro_Google_Service_Analytics_Goal extends NxPro_Google_Model
{
  public $accountId;
  public $active;
  public $created;
  protected $eventDetailsType = 'NxPro_Google_Service_Analytics_GoalEventDetails';
  protected $eventDetailsDataType = '';
  public $id;
  public $internalWebPropertyId;
  public $kind;
  public $name;
  protected $parentLinkType = 'NxPro_Google_Service_Analytics_GoalParentLink';
  protected $parentLinkDataType = '';
  public $profileId;
  public $selfLink;
  public $type;
  public $updated;
  protected $urlDestinationDetailsType = 'NxPro_Google_Service_Analytics_GoalUrlDestinationDetails';
  protected $urlDestinationDetailsDataType = '';
  public $value;
  protected $visitNumPagesDetailsType = 'NxPro_Google_Service_Analytics_GoalVisitNumPagesDetails';
  protected $visitNumPagesDetailsDataType = '';
  protected $visitTimeOnSiteDetailsType = 'NxPro_Google_Service_Analytics_GoalVisitTimeOnSiteDetails';
  protected $visitTimeOnSiteDetailsDataType = '';
  public $webPropertyId;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  public function setActive($active)
  {
    $this->active = $active;
  }
  public function getActive()
  {
    return $this->active;
  }
  public function setCreated($created)
  {
    $this->created = $created;
  }
  public function getCreated()
  {
    return $this->created;
  }
  /**
   * @param NxPro_Google_Service_Analytics_GoalEventDetails
   */
  public function setEventDetails(NxPro_Google_Service_Analytics_GoalEventDetails $eventDetails)
  {
    $this->eventDetails = $eventDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_GoalEventDetails
   */
  public function getEventDetails()
  {
    return $this->eventDetails;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  public function setInternalWebPropertyId($internalWebPropertyId)
  {
    $this->internalWebPropertyId = $internalWebPropertyId;
  }
  public function getInternalWebPropertyId()
  {
    return $this->internalWebPropertyId;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param NxPro_Google_Service_Analytics_GoalParentLink
   */
  public function setParentLink(NxPro_Google_Service_Analytics_GoalParentLink $parentLink)
  {
    $this->parentLink = $parentLink;
  }
  /**
   * @return NxPro_Google_Service_Analytics_GoalParentLink
   */
  public function getParentLink()
  {
    return $this->parentLink;
  }
  public function setProfileId($profileId)
  {
    $this->profileId = $profileId;
  }
  public function getProfileId()
  {
    return $this->profileId;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  public function setUpdated($updated)
  {
    $this->updated = $updated;
  }
  public function getUpdated()
  {
    return $this->updated;
  }
  /**
   * @param NxPro_Google_Service_Analytics_GoalUrlDestinationDetails
   */
  public function setUrlDestinationDetails(NxPro_Google_Service_Analytics_GoalUrlDestinationDetails $urlDestinationDetails)
  {
    $this->urlDestinationDetails = $urlDestinationDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_GoalUrlDestinationDetails
   */
  public function getUrlDestinationDetails()
  {
    return $this->urlDestinationDetails;
  }
  public function setValue($value)
  {
    $this->value = $value;
  }
  public function getValue()
  {
    return $this->value;
  }
  /**
   * @param NxPro_Google_Service_Analytics_GoalVisitNumPagesDetails
   */
  public function setVisitNumPagesDetails(NxPro_Google_Service_Analytics_GoalVisitNumPagesDetails $visitNumPagesDetails)
  {
    $this->visitNumPagesDetails = $visitNumPagesDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_GoalVisitNumPagesDetails
   */
  public function getVisitNumPagesDetails()
  {
    return $this->visitNumPagesDetails;
  }
  /**
   * @param NxPro_Google_Service_Analytics_GoalVisitTimeOnSiteDetails
   */
  public function setVisitTimeOnSiteDetails(NxPro_Google_Service_Analytics_GoalVisitTimeOnSiteDetails $visitTimeOnSiteDetails)
  {
    $this->visitTimeOnSiteDetails = $visitTimeOnSiteDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_GoalVisitTimeOnSiteDetails
   */
  public function getVisitTimeOnSiteDetails()
  {
    return $this->visitTimeOnSiteDetails;
  }
  public function setWebPropertyId($webPropertyId)
  {
    $this->webPropertyId = $webPropertyId;
  }
  public function getWebPropertyId()
  {
    return $this->webPropertyId;
  }
}
