<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Service;

/**
 * Service
 *   Terpsichore.Service.Service is an abstract interface to define "Usecase of the Social External Service"
 *   For e.g.
 *    TwitterService is a Service which
 *      - provides the flow of the authenticate and the action.
 *         If user is not authenticated, then call authenticate,
 *         Otherwise, use Authenticated of the Service instance to call actions.
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
interface Service
{
}

