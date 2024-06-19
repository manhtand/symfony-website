<?php

namespace App\Entity;

use App\Repository\SeasonAverageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonAverageRepository::class)]
class SeasonAverage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pts = null;

    #[ORM\Column]
    private ?int $ast = null;

    #[ORM\Column]
    private ?int $turnover = null;

    #[ORM\Column]
    private ?int $pf = null;

    #[ORM\Column]
    private ?int $fga = null;

    #[ORM\Column]
    private ?int $fgm = null;

    #[ORM\Column]
    private ?int $fta = null;

    #[ORM\Column]
    private ?int $ftm = null;

    #[ORM\Column]
    private ?int $reb = null;

    #[ORM\Column]
    private ?int $stl = null;

    #[ORM\Column]
    private ?int $blk = null;

    #[ORM\Column]
    private ?int $player_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPts(): ?int
    {
        return $this->pts;
    }

    public function setPts(int $pts): static
    {
        $this->pts = $pts;

        return $this;
    }

    public function getAst(): ?int
    {
        return $this->ast;
    }

    public function setAst(int $ast): static
    {
        $this->ast = $ast;

        return $this;
    }

    public function getTurnover(): ?int
    {
        return $this->turnover;
    }

    public function setTurnover(int $turnover): static
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getPf(): ?int
    {
        return $this->pf;
    }

    public function setPf(int $pf): static
    {
        $this->pf = $pf;

        return $this;
    }

    public function getFga(): ?int
    {
        return $this->fga;
    }

    public function setFga(int $fga): static
    {
        $this->fga = $fga;

        return $this;
    }

    public function getFgm(): ?int
    {
        return $this->fgm;
    }

    public function setFgm(int $fgm): static
    {
        $this->fgm = $fgm;

        return $this;
    }

    public function getFta(): ?int
    {
        return $this->fta;
    }

    public function setFta(int $fta): static
    {
        $this->fta = $fta;

        return $this;
    }

    public function getFtm(): ?int
    {
        return $this->ftm;
    }

    public function setFtm(int $ftm): static
    {
        $this->ftm = $ftm;

        return $this;
    }

    public function getReb(): ?int
    {
        return $this->reb;
    }

    public function setReb(int $reb): static
    {
        $this->reb = $reb;

        return $this;
    }

    public function getStl(): ?int
    {
        return $this->stl;
    }

    public function setStl(int $stl): static
    {
        $this->stl = $stl;

        return $this;
    }

    public function getBlk(): ?int
    {
        return $this->blk;
    }

    public function setBlk(int $blk): static
    {
        $this->blk = $blk;

        return $this;
    }

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function setPlayerId(?int $playerId): static
    {
        $this->player_id = $playerId;

        return $this;
    }
}
