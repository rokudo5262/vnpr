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

class NxPro_Google_Service_Analytics_Filter extends NxPro_Google_Model
{
  public $accountId;
  protected $advancedDetailsType = 'NxPro_Google_Service_Analytics_FilterAdvancedDetails';
  protected $advancedDetailsDataType = '';
  public $created;
  protected $excludeDetailsType = 'NxPro_Google_Service_Analytics_FilterExpression';
  protected $excludeDetailsDataType = '';
  public $id;
  protected $includeDetailsType = 'NxPro_Google_Service_Analytics_FilterExpression';
  protected $includeDetailsDataType = '';
  public $kind;
  protected $lowercaseDetailsType = 'NxPro_Google_Service_Analytics_FilterLowercaseDetails';
  protected $lowercaseDetailsDataType = '';
  public $name;
  protected $parentLinkType = 'NxPro_Google_Service_Analytics_FilterParentLink';
  protected $parentLinkDataType = '';
  protected $searchAndReplaceDetailsType = 'NxPro_Google_Service_Analytics_FilterSearchAndReplaceDetails';
  protected $searchAndReplaceDetailsDataType = '';
  public $selfLink;
  public $type;
  public $updated;
  protected $uppercaseDetailsType = 'NxPro_Google_Service_Analytics_FilterUppercaseDetails';
  protected $uppercaseDetailsDataType = '';

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  /**
   * @param NxPro_Google_Service_Analytics_FilterAdvancedDetails
   */
  public function setAdvancedDetails(NxPro_Google_Service_Analytics_FilterAdvancedDetails $advancedDetails)
  {
    $this->advancedDetails = $advancedDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterAdvancedDetails
   */
  public function getAdvancedDetails()
  {
    return $this->advancedDetails;
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
   * @param NxPro_Google_Service_Analytics_FilterExpression
   */
  public function setExcludeDetails(NxPro_Google_Service_Analytics_FilterExpression $excludeDetails)
  {
    $this->excludeDetails = $excludeDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterExpression
   */
  public function getExcludeDetails()
  {
    return $this->excludeDetails;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param NxPro_Google_Service_Analytics_FilterExpression
   */
  public function setIncludeDetails(NxPro_Google_Service_Analytics_FilterExpression $includeDetails)
  {
    $this->includeDetails = $includeDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterExpression
   */
  public function getIncludeDetails()
  {
    return $this->includeDetails;
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
   * @param NxPro_Google_Service_Analytics_FilterLowercaseDetails
   */
  public function setLowercaseDetails(NxPro_Google_Service_Analytics_FilterLowercaseDetails $lowercaseDetails)
  {
    $this->lowercaseDetails = $lowercaseDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterLowercaseDetails
   */
  public function getLowercaseDetails()
  {
    return $this->lowercaseDetails;
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
   * @param NxPro_Google_Service_Analytics_FilterParentLink
   */
  public function setParentLink(NxPro_Google_Service_Analytics_FilterParentLink $parentLink)
  {
    $this->parentLink = $parentLink;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterParentLink
   */
  public function getParentLink()
  {
    return $this->parentLink;
  }
  /**
   * @param NxPro_Google_Service_Analytics_FilterSearchAndReplaceDetails
   */
  public function setSearchAndReplaceDetails(NxPro_Google_Service_Analytics_FilterSearchAndReplaceDetails $searchAndReplaceDetails)
  {
    $this->searchAndReplaceDetails = $searchAndReplaceDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterSearchAndReplaceDetails
   */
  public function getSearchAndReplaceDetails()
  {
    return $this->searchAndReplaceDetails;
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
   * @param NxPro_Google_Service_Analytics_FilterUppercaseDetails
   */
  public function setUppercaseDetails(NxPro_Google_Service_Analytics_FilterUppercaseDetails $uppercaseDetails)
  {
    $this->uppercaseDetails = $uppercaseDetails;
  }
  /**
   * @return NxPro_Google_Service_Analytics_FilterUppercaseDetails
   */
  public function getUppercaseDetails()
  {
    return $this->uppercaseDetails;
  }
}
