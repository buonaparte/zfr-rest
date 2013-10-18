<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace ZfrRest\Mvc\Controller\MethodHandler;

use Zend\Mvc\Controller\AbstractController;
use Zend\Stdlib\ResponseInterface;
use ZfrRest\Mvc\Controller\MethodHandler\MethodHandlerInterface;
use ZfrRest\Options\ControllerBehavioursOptions;
use ZfrRest\Resource\ResourceInterface;

/**
 * Handler for the PUT method verb
 *
 * The PUT request allow the client to modify an existing resource
 *
 * @link    http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.6
 * @author  Michaël Gallego <mic.gallego@gmail.com>
 * @licence MIT
 */
class PutHandler implements MethodHandlerInterface
{
    /**
     * @var ControllerBehavioursOptions
     */
    protected $controllerBehaviourOptions;

    /**
     * Constructor
     *
     * @param ControllerBehavioursOptions $controllerBehavioursOptions
     */
    public function __construct(ControllerBehavioursOptions $controllerBehavioursOptions)
    {
        $this->controllerBehaviourOptions = $controllerBehavioursOptions;
    }

    /**
     * Handler for PUT method
     *
     * PUT method is used to update an existing resource. We are doing several things for the user automatically:
     *      - we validate post data with the input filter defined in metadata
     *      - we hydrate valid data to update existing resource
     *      - we pass the object to the put method of the controller
     *
     * Note that if you have set "auto_validate" and/or "auto_hydrate" to false in ZfrRest config, those steps will
     * do nothing
     *
     * @param  AbstractController $controller
     * @param  ResourceInterface $resource
     * @return ResponseInterface
     */
    public function handleMethod(AbstractController $controller, ResourceInterface $resource)
    {
        // If no put method is defined on the controller, then we cannot do anything
        if (!method_exists($controller, 'put')) {
            // @TODO: throw exception
        }

        $result = $controller->put($resource);

        return $result;
    }
}