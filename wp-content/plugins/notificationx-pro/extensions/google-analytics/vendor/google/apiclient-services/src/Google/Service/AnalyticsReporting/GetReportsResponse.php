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

class NxPro_Google_Service_AnalyticsReporting_GetReportsResponse extends NxPro_Google_Collection
{
  protected $collection_key = 'reports';
  public $queryCost;
  protected $reportsType = 'NxPro_Google_Service_AnalyticsReporting_Report';
  protected $reportsDataType = 'array';
  protected $resourceQuotasRemainingType = 'NxPro_Google_Service_AnalyticsReporting_ResourceQuotasRemaining';
  protected $resourceQuotasRemainingDataType = '';

  public function setQueryCost($queryCost)
  {
    $this->queryCost = $queryCost;
  }
  public function getQueryCost()
  {
    return $this->queryCost;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_Report
   */
  public function setReports($reports)
  {
    $this->reports = $reports;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_Report
   */
  public function getReports()
  {
    return $this->reports;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_ResourceQuotasRemaining
   */
  public function setResourceQuotasRemaining(NxPro_Google_Service_AnalyticsReporting_ResourceQuotasRemaining $resourceQuotasRemaining)
  {
    $this->resourceQuotasRemaining = $resourceQuotasRemaining;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_ResourceQuotasRemaining
   */
  public function getResourceQuotasRemaining()
  {
    return $this->resourceQuotasRemaining;
  }
}
