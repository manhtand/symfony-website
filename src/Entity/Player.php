<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name = null;

    #[ORM\Column(length: 5)]
    private ?string $position = null;

    #[ORM\Column(length: 10)]
    private ?string $height = null;

    #[ORM\Column(length: 3)]
    private ?string $weight = null;

    #[ORM\Column(length: 10)]
    private ?string $jersey_number = null;

    #[ORM\Column(length: 50)]
    private ?string $country = null;

    #[ORM\Column]
    private ?int $draft_year = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?SeasonAverage $season_average_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getJerseyNumber(): ?string
    {
        return $this->jersey_number;
    }

    public function setJerseyNumber(string $jersey_number): static
    {
        $this->jersey_number = $jersey_number;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getDraftYear(): ?int
    {
        return $this->draft_year;
    }

    public function setDraftYear(int $draft_year): static
    {
        $this->draft_year = $draft_year;

        return $this;
    }

    public function getTeamId(): ?Team
    {
        return $this->team_id;
    }

    public function setTeamId(Team $team_id): static
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getSeasonAverageId(): ?SeasonAverage
    {
        return $this->season_average_id;
    }

    public function setSeasonAverageId(?SeasonAverage $season_average_id): static
    {
        $this->season_average_id = $season_average_id;

        return $this;
    }
}
