<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:18 01.11.2019
 */

namespace Daktela\Filters;

class FilterOperatorEnumeration
{
    const EQUAL = 'eq';
    const NOT_EQUAL = 'neq';
    const LESS_THAN = 'lt';
    const LESS_THAN_OR_EQUAL = 'lte';
    const GREATER_THAN = 'gt';
    const GREATER_THAN_OR_EQUAL = 'gte';
    const LIKE = 'like';
    const CONTAINS = 'contains';
    const STARTS_WITH = 'startswith';
    const ENDS_WITH = 'endswith';
    const NOT_LIKE = 'notlike';
    const DOES_NOT_CONTAIN = 'doesnotcontain';
    const IS_NULL = 'isnull';
    const IS_NOT_NULL = 'isnotnull';
    const IN = 'in';
    const NOT_IN = 'notin';
}