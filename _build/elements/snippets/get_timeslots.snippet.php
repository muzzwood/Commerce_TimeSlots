<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 */

// Instantiate the Commerce_Timeslots class
$path = $modx->getOption('commerce_timeslots.core_path', null, MODX_CORE_PATH . 'components/commerce_timeslots/') . 'model/commerce_timeslots/';
$params = ['mode' => $modx->getOption('commerce.mode')];

/** @var Commerce_Timeslots|null $timeslots */
$timeslots = $modx->getService('commerce_timeslots', 'Commerce_Timeslots', $path, $params);
if (!($timeslots instanceof Commerce_Timeslots)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Could not load Commerce_Timeslots service in commerce_timeslots.get_timeslots snippet.');
    return 'Could not load Commerce_Timeslots. Please try again later.';
}

if ($timeslots->commerce->isDisabled()) {
    return $timeslots->commerce->adapter->lexicon('commerce.mode.disabled.message');
}

return $timeslots->getTimeslots($scriptProperties);