<?php

namespace App\Entity;

use FOS\UserBundle\Model\UserInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Concrete;

/**
 * @method string getUserIdentifier()
 */
abstract class UserF extends Concrete implements UserInterface
{

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }


    public function setLastLogin(\DateTime $time = null)
    {
        // TODO: Implement setLastLogin() method.
    }


    ////
    public function setPlainPassword($password)
    {
        // TODO: Implement setPlainPassword() method.
    }

    public function getPlainPassword()
    {
        // TODO: Implement getPlainPassword() method.
    }

    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        // TODO: Implement setPasswordRequestedAt() method.
    }

    public function isPasswordRequestNonExpired($ttl)
    {
        // TODO: Implement isPasswordRequestNonExpired() method.
    }
    ////


    ////
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(DataObject\Role::getByRoleName('admin'));
    }

    public function setSuperAdmin($boolean)
    {
        // TODO: Implement setSuperAdmin() method.
    }
    ////


    ////
    public function setEnabled($boolean)
    {
        // TODO: Implement setEnabled() method.
    }

    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }
    ////

    ////
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    ////

    ////
    public function getConfirmationToken()
    {
        // TODO: Implement getConfirmationToken() method.
    }

    public function setConfirmationToken($confirmationToken)
    {
        // TODO: Implement setConfirmationToken() method.
    }
    ////


    ////
    public function setRoles(array $roles)
    {
        // TODO: Implement setRoles() method.
    }
    /**
     * @throws \Exception
     */
    public function getRoles() : array
    {
         $roles = DataObject\Role::getList();
        // we need to make sure to have at least one role
        return array_values(array_unique((array)$roles));
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function addRole($role)
    {
        // TODO: Implement addRole() method.
    }

    public function removeRole($role)
    {
        // TODO: Implement removeRole() method.
    }
    ////



}
