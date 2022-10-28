<?php

namespace App\Entity;

use FOS\UserBundle\Model\UserInterface;
use Pimcore\Model\DataObject\Concrete;

/**
 * @method string getUserIdentifier()
 */
abstract class UserF extends Concrete implements UserInterface
{

    protected $id;

    public function __construct()
    {
        parent::__construct();

    }

    public function setPassword($password)
    {
        // TODO: Implement setPassword() method.
    }

    public function setLastLogin(\DateTime $time = null)
    {
        // TODO: Implement setLastLogin() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function getUsernameCanonical()
    {
        // TODO: Implement getUsernameCanonical() method.
    }

    public function setSalt($salt)
    {
        // TODO: Implement setSalt() method.
    }

    public function getEmail()
    {
        // TODO: Implement getEmail() method.
    }

    public function setPlainPassword($password)
    {
        // TODO: Implement setPlainPassword() method.
    }

    public function isSuperAdmin()
    {
        // TODO: Implement isSuperAdmin() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setUsername($username)
    {
        // TODO: Implement setUsername() method.
    }

    public function setUsernameCanonical($usernameCanonical)
    {
        // TODO: Implement setUsernameCanonical() method.
    }

    public function setEmail($email)
    {
        // TODO: Implement setEmail() method.
    }

    public function getEmailCanonical()
    {
        // TODO: Implement getEmailCanonical() method.
    }

    public function setEmailCanonical($emailCanonical)
    {
        // TODO: Implement setEmailCanonical() method.
    }

    public function getPlainPassword()
    {
        // TODO: Implement getPlainPassword() method.
    }

    public function setEnabled($boolean)
    {
        // TODO: Implement setEnabled() method.
    }

    public function setSuperAdmin($boolean)
    {
        // TODO: Implement setSuperAdmin() method.
    }

    public function getConfirmationToken()
    {
        // TODO: Implement getConfirmationToken() method.
    }

    public function setConfirmationToken($confirmationToken)
    {
        // TODO: Implement setConfirmationToken() method.
    }

    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        // TODO: Implement setPasswordRequestedAt() method.
    }

    public function setRoles(array $roles)
    {
        // TODO: Implement setRoles() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function isPasswordRequestNonExpired($ttl)
    {
        // TODO: Implement isPasswordRequestNonExpired() method.
    }

    public function hasRole($role)
    {
        // TODO: Implement hasRole() method.
    }

    public function addRole($role)
    {
        // TODO: Implement addRole() method.
    }

    public function removeRole($role)
    {
        // TODO: Implement removeRole() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
