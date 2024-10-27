<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Compte extends \App\Entity\Compte implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'nomCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'categorie', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'type', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'paysSiege', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'paysImplantationSuccursales', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'secteurs', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'chiffreAffaires', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'detailLibre', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'signalement', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'responsableCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'etatCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'carteVisites', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'projets', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'ca_export', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'centreDecision', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'contact', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'logo', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'creePar', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'dateCreation', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'modifiePar', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'dateModification', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'compteData', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'events', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'status', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'logComptes', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'contacts', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'GPAC', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'ecosystemeFiliere'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'nomCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'categorie', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'type', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'paysSiege', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'paysImplantationSuccursales', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'secteurs', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'chiffreAffaires', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'detailLibre', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'signalement', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'responsableCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'etatCompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'carteVisites', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'projets', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'ca_export', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'centreDecision', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'contact', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'logo', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'creePar', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'dateCreation', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'modifiePar', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'dateModification', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'compteData', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'events', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'status', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'logComptes', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'contacts', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'GPAC', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'ecosystemeFiliere'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Compte $proxy) {
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
    public function getNomCompte(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomCompte', []);

        return parent::getNomCompte();
    }

    /**
     * {@inheritDoc}
     */
    public function setNomCompte(string $nomCompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNomCompte', [$nomCompte]);

        return parent::setNomCompte($nomCompte);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategorie(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategorie', []);

        return parent::getCategorie();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategorie(bool $categorie): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategorie', [$categorie]);

        return parent::setCategorie($categorie);
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): ?\App\Entity\typeCompte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', []);

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType(?\App\Entity\typeCompte $type): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', [$type]);

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaysSiege(): ?\App\Entity\pays
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaysSiege', []);

        return parent::getPaysSiege();
    }

    /**
     * {@inheritDoc}
     */
    public function setPaysSiege(?\App\Entity\pays $paysSiege): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPaysSiege', [$paysSiege]);

        return parent::setPaysSiege($paysSiege);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaysImplantationSuccursales(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaysImplantationSuccursales', []);

        return parent::getPaysImplantationSuccursales();
    }

    /**
     * {@inheritDoc}
     */
    public function addPaysImplantationSuccursale(\App\Entity\pays $paysImplantationSuccursale): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPaysImplantationSuccursale', [$paysImplantationSuccursale]);

        return parent::addPaysImplantationSuccursale($paysImplantationSuccursale);
    }

    /**
     * {@inheritDoc}
     */
    public function removePaysImplantationSuccursale(\App\Entity\pays $paysImplantationSuccursale): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePaysImplantationSuccursale', [$paysImplantationSuccursale]);

        return parent::removePaysImplantationSuccursale($paysImplantationSuccursale);
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
    public function addSecteur(\App\Entity\Secteur $secteur): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSecteur', [$secteur]);

        return parent::addSecteur($secteur);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSecteur(\App\Entity\Secteur $secteur): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSecteur', [$secteur]);

        return parent::removeSecteur($secteur);
    }

    /**
     * {@inheritDoc}
     */
    public function getChiffreAffaires(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getChiffreAffaires', []);

        return parent::getChiffreAffaires();
    }

    /**
     * {@inheritDoc}
     */
    public function setChiffreAffaires(?string $chiffreAffaires): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setChiffreAffaires', [$chiffreAffaires]);

        return parent::setChiffreAffaires($chiffreAffaires);
    }

    /**
     * {@inheritDoc}
     */
    public function getDetailLibre(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDetailLibre', []);

        return parent::getDetailLibre();
    }

    /**
     * {@inheritDoc}
     */
    public function setDetailLibre(?string $detailLibre): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDetailLibre', [$detailLibre]);

        return parent::setDetailLibre($detailLibre);
    }

    /**
     * {@inheritDoc}
     */
    public function getSignalement(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSignalement', []);

        return parent::getSignalement();
    }

    /**
     * {@inheritDoc}
     */
    public function setSignalement(bool $signalement): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSignalement', [$signalement]);

        return parent::setSignalement($signalement);
    }

    /**
     * {@inheritDoc}
     */
    public function getResponsableCompte(): ?\App\Entity\user
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResponsableCompte', []);

        return parent::getResponsableCompte();
    }

    /**
     * {@inheritDoc}
     */
    public function setResponsableCompte(?\App\Entity\user $responsableCompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResponsableCompte', [$responsableCompte]);

        return parent::setResponsableCompte($responsableCompte);
    }

    /**
     * {@inheritDoc}
     */
    public function getEtatCompte(): ?\App\Entity\etatCompte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEtatCompte', []);

        return parent::getEtatCompte();
    }

    /**
     * {@inheritDoc}
     */
    public function setEtatCompte(?\App\Entity\etatCompte $etatCompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEtatCompte', [$etatCompte]);

        return parent::setEtatCompte($etatCompte);
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
    public function setIsDeleted(bool $isDeleted): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDeleted', [$isDeleted]);

        return parent::setIsDeleted($isDeleted);
    }

    /**
     * {@inheritDoc}
     */
    public function getCarteVisites(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCarteVisites', []);

        return parent::getCarteVisites();
    }

    /**
     * {@inheritDoc}
     */
    public function addCarteVisite(\App\Entity\CarteVisite $carteVisite): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCarteVisite', [$carteVisite]);

        return parent::addCarteVisite($carteVisite);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCarteVisite(\App\Entity\CarteVisite $carteVisite): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCarteVisite', [$carteVisite]);

        return parent::removeCarteVisite($carteVisite);
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
    public function addProjet(\App\Entity\Projets $projet): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProjet', [$projet]);

        return parent::addProjet($projet);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProjet(\App\Entity\Projets $projet): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProjet', [$projet]);

        return parent::removeProjet($projet);
    }

    /**
     * {@inheritDoc}
     */
    public function getCaExport(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCaExport', []);

        return parent::getCaExport();
    }

    /**
     * {@inheritDoc}
     */
    public function setCaExport(?string $ca_export): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCaExport', [$ca_export]);

        return parent::setCaExport($ca_export);
    }

    /**
     * {@inheritDoc}
     */
    public function getCentreDecision(): ?\App\Entity\Pays
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCentreDecision', []);

        return parent::getCentreDecision();
    }

    /**
     * {@inheritDoc}
     */
    public function setCentreDecision(?\App\Entity\Pays $centreDecision): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCentreDecision', [$centreDecision]);

        return parent::setCentreDecision($centreDecision);
    }

    /**
     * {@inheritDoc}
     */
    public function getContact(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContact', []);

        return parent::getContact();
    }

    /**
     * {@inheritDoc}
     */
    public function addContact(\App\Entity\Contact $contact): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addContact', [$contact]);

        return parent::addContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function removeContact(\App\Entity\Contact $contact): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeContact', [$contact]);

        return parent::removeContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function getLogo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogo', []);

        return parent::getLogo();
    }

    /**
     * {@inheritDoc}
     */
    public function setLogo($logo): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLogo', [$logo]);

        return parent::setLogo($logo);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreePar(): ?\App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreePar', []);

        return parent::getCreePar();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreePar(?\App\Entity\User $creePar): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreePar', [$creePar]);

        return parent::setCreePar($creePar);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreation(): ?\DateTimeImmutable
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreation', []);

        return parent::getDateCreation();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreation(?\DateTimeImmutable $dateCreation): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreation', [$dateCreation]);

        return parent::setDateCreation($dateCreation);
    }

    /**
     * {@inheritDoc}
     */
    public function getModifiePar(): ?\App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModifiePar', []);

        return parent::getModifiePar();
    }

    /**
     * {@inheritDoc}
     */
    public function setModifiePar(?\App\Entity\User $modifiePar): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModifiePar', [$modifiePar]);

        return parent::setModifiePar($modifiePar);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateModification(): ?\DateTimeImmutable
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateModification', []);

        return parent::getDateModification();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateModification(?\DateTimeImmutable $dateModification): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateModification', [$dateModification]);

        return parent::setDateModification($dateModification);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompteData(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompteData', []);

        return parent::getCompteData();
    }

    /**
     * {@inheritDoc}
     */
    public function addCompteData(\App\Entity\CompteData $compteData): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCompteData', [$compteData]);

        return parent::addCompteData($compteData);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCompteData(\App\Entity\CompteData $compteData): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCompteData', [$compteData]);

        return parent::removeCompteData($compteData);
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
    public function addEvent(\App\Entity\Event $event): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEvent', [$event]);

        return parent::addEvent($event);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEvent(\App\Entity\Event $event): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEvent', [$event]);

        return parent::removeEvent($event);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): ?array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(?array $status): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getLogComptes(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogComptes', []);

        return parent::getLogComptes();
    }

    /**
     * {@inheritDoc}
     */
    public function addLogCompte(\App\Entity\LogCompte $logCompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addLogCompte', [$logCompte]);

        return parent::addLogCompte($logCompte);
    }

    /**
     * {@inheritDoc}
     */
    public function removeLogCompte(\App\Entity\LogCompte $logCompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeLogCompte', [$logCompte]);

        return parent::removeLogCompte($logCompte);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
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
    public function getGPAC(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGPAC', []);

        return parent::getGPAC();
    }

    /**
     * {@inheritDoc}
     */
    public function setGPAC(?bool $GPAC): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGPAC', [$GPAC]);

        return parent::setGPAC($GPAC);
    }

    /**
     * {@inheritDoc}
     */
    public function getEcosystemeFiliere(): ?\App\Entity\EcosystemeFiliere
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEcosystemeFiliere', []);

        return parent::getEcosystemeFiliere();
    }

    /**
     * {@inheritDoc}
     */
    public function setEcosystemeFiliere(?\App\Entity\EcosystemeFiliere $ecosystemeFiliere): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEcosystemeFiliere', [$ecosystemeFiliere]);

        return parent::setEcosystemeFiliere($ecosystemeFiliere);
    }

}
