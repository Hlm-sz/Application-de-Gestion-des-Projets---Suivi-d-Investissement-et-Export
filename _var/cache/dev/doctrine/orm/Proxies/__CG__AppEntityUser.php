<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \App\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\User' . "\0" . 'id', '' . "\0" . 'App\\Entity\\User' . "\0" . 'email', '' . "\0" . 'App\\Entity\\User' . "\0" . 'roles', '' . "\0" . 'App\\Entity\\User' . "\0" . 'password', '' . "\0" . 'App\\Entity\\User' . "\0" . 'groupe', '' . "\0" . 'App\\Entity\\User' . "\0" . 'nom', '' . "\0" . 'App\\Entity\\User' . "\0" . 'prenom', '' . "\0" . 'App\\Entity\\User' . "\0" . 'comptes', '' . "\0" . 'App\\Entity\\User' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entity\\User' . "\0" . 'secteurs', '' . "\0" . 'App\\Entity\\User' . "\0" . 'contacts', '' . "\0" . 'App\\Entity\\User' . "\0" . 'projets', '' . "\0" . 'App\\Entity\\User' . "\0" . 'photo', '' . "\0" . 'App\\Entity\\User' . "\0" . 'events'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\User' . "\0" . 'id', '' . "\0" . 'App\\Entity\\User' . "\0" . 'email', '' . "\0" . 'App\\Entity\\User' . "\0" . 'roles', '' . "\0" . 'App\\Entity\\User' . "\0" . 'password', '' . "\0" . 'App\\Entity\\User' . "\0" . 'groupe', '' . "\0" . 'App\\Entity\\User' . "\0" . 'nom', '' . "\0" . 'App\\Entity\\User' . "\0" . 'prenom', '' . "\0" . 'App\\Entity\\User' . "\0" . 'comptes', '' . "\0" . 'App\\Entity\\User' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entity\\User' . "\0" . 'secteurs', '' . "\0" . 'App\\Entity\\User' . "\0" . 'contacts', '' . "\0" . 'App\\Entity\\User' . "\0" . 'projets', '' . "\0" . 'App\\Entity\\User' . "\0" . 'photo', '' . "\0" . 'App\\Entity\\User' . "\0" . 'events'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoles', []);

        return parent::getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function setRoles(array $roles): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRoles', [$roles]);

        return parent::setRoles($roles);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', []);

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'eraseCredentials', []);

        return parent::eraseCredentials();
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupe(): ?\App\Entity\Groupe
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupe', []);

        return parent::getGroupe();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroupe(?\App\Entity\Groupe $groupe): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroupe', [$groupe]);

        return parent::setGroupe($groupe);
    }

    /**
     * {@inheritDoc}
     */
    public function getNom(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNom', []);

        return parent::getNom();
    }

    /**
     * {@inheritDoc}
     */
    public function setNom(string $nom): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNom', [$nom]);

        return parent::setNom($nom);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrenom(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrenom', []);

        return parent::getPrenom();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrenom(string $prenom): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrenom', [$prenom]);

        return parent::setPrenom($prenom);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsDeleted(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsDeleted', []);

        return parent::getIsDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDeleted(?bool $isDeleted): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDeleted', [$isDeleted]);

        return parent::setIsDeleted($isDeleted);
    }

    /**
     * {@inheritDoc}
     */
    public function getSecteurs(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSecteurs', []);

        return parent::getSecteurs();
    }

    /**
     * {@inheritDoc}
     */
    public function addSecteur(\App\Entity\Secteur $secteur): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSecteur', [$secteur]);

        return parent::addSecteur($secteur);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSecteur(\App\Entity\Secteur $secteur): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSecteur', [$secteur]);

        return parent::removeSecteur($secteur);
    }

    /**
     * {@inheritDoc}
     */
    public function getComptes(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComptes', []);

        return parent::getComptes();
    }

    /**
     * {@inheritDoc}
     */
    public function addCompte(\App\Entity\Compte $compte): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCompte', [$compte]);

        return parent::addCompte($compte);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCompte(\App\Entity\Compte $compte): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCompte', [$compte]);

        return parent::removeCompte($compte);
    }

    /**
     * {@inheritDoc}
     */
    public function getContacts(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContacts', []);

        return parent::getContacts();
    }

    /**
     * {@inheritDoc}
     */
    public function addContact(\App\Entity\Contact $contact): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addContact', [$contact]);

        return parent::addContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function removeContact(\App\Entity\Contact $contact): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeContact', [$contact]);

        return parent::removeContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function getProjets(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProjets', []);

        return parent::getProjets();
    }

    /**
     * {@inheritDoc}
     */
    public function addProjet(\App\Entity\Projets $projet): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProjet', [$projet]);

        return parent::addProjet($projet);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProjet(\App\Entity\Projets $projet): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProjet', [$projet]);

        return parent::removeProjet($projet);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhoto', []);

        return parent::getPhoto();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoto($photo): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhoto', [$photo]);

        return parent::setPhoto($photo);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', []);

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unserialize', [$serialized]);

        return parent::unserialize($serialized);
    }

    /**
     * {@inheritDoc}
     */
    public function toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toString', []);

        return parent::toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getEvents(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEvents', []);

        return parent::getEvents();
    }

    /**
     * {@inheritDoc}
     */
    public function addEvent(\App\Entity\Event $event): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEvent', [$event]);

        return parent::addEvent($event);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEvent(\App\Entity\Event $event): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEvent', [$event]);

        return parent::removeEvent($event);
    }

    /**
     * {@inheritDoc}
     */
    public function nomcomplet()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'nomcomplet', []);

        return parent::nomcomplet();
    }

}