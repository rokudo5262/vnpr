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

class NxPro_Google_Service_AnalyticsReporting_MetricFilterClause extends NxPro_Google_Collection
{
  protected $collection_key = 'filters';
  protected $filtersType = 'NxPro_Google_Service_AnalyticsReporting_MetricFilter';
  protected $filtersDataType = 'array';
  public $operator;

  /**
   * @param NxPro_Google_Service_AnalyticsReporting_MetricFilter
   */
  public function setFilters($filters)
  {
    $this->filters = $filters;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_MetricFilter
   */
  public function getFilters()
  {
    return $this->filters;
  }
  public function setOperator($operator)
  {
    $this->operator = $operator;
  }
  public function getOperator()
  {
    return $this->operator;
  }
}
