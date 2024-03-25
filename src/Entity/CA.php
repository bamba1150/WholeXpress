<?php

namespace App\Entity;

use App\Repository\CARepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CARepository::class)]
class CA extends User
{
    #[ORM\OneToMany(mappedBy: 'ca', targetEntity: Achat::class)]
    private Collection $achats;

    public function __construct()
    {
        parent::__construct();
        $this->achats = new ArrayCollection();
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): static
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setCa($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): static
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getCa() === $this) {
                $achat->setCa(null);
            }
        }

        return $this;
    }
}
