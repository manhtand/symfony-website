<?php

namespace App\Controller;

use App\DataService\PlayerService;
use App\DataService\TeamService;
use App\Entity\Player;
use App\Entity\SeasonAverage;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    private PlayerService $playerService;
    private TeamService $teamService;
    private EntityManagerInterface $entityManager;
    private $famousPlayers = [];

    public function __construct(PlayerService $playerService, TeamService $teamService, EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->teamService = $teamService;
        $this->playerService = $playerService;
        $this->createPopularPlayerArray();
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $player = $this->getPlayer();
        $teams = $this->getTeams();
        $seasonAverage = $this->getSeasonAverageOfPlayer($player);

        return $this->render('homepage/index.html.twig', [
            'teams' => $teams,
            'player' => $player,
            'seasonAverage' => $seasonAverage,
        ]);
    }

    private function getPlayerWithName(string $first_name, string $last_name, PlayerRepository $playerRepository): Player {
        return $playerRepository->findOneBy([
            'first_name' => $first_name,
            'last_name' => $last_name,
        ]);
    }

    private function getSeasonAverageOfPlayer(Player $player): SeasonAverage
    {
        $seasonAverageData = $this->playerService->getSeasonAverageWithId($player->getId());
        $seasonAverageRepository = $this->entityManager->getRepository(SeasonAverage::class);
        $seasonAverage = $seasonAverageRepository->findOneBy(['player_id' => $player->getId()]);

        if (!$seasonAverage) {
            $seasonAverage = new SeasonAverage();
            $this->setSeasonAverageInfo($seasonAverage, $seasonAverageData);
            $this->entityManager->persist($seasonAverage);
        } else {
            $this->setSeasonAverageInfo($seasonAverage, $seasonAverageData);
        }
        $player->setSeasonAverageId($seasonAverage);

        $this->entityManager->flush();
        return $seasonAverage;
    }

    private function setSeasonAverageInfo(SeasonAverage $seasonAverage, mixed $seasonAverageData): void {
        $seasonAverage->setPts($seasonAverageData['pts']);
        $seasonAverage->setAst($seasonAverageData['ast']);
        $seasonAverage->setTurnover($seasonAverageData['turnover']);
        $seasonAverage->setPf($seasonAverageData['pf']);
        $seasonAverage->setFga($seasonAverageData['fga']);
        $seasonAverage->setFgm($seasonAverageData['fgm']);
        $seasonAverage->setFta($seasonAverageData['fta']);
        $seasonAverage->setFtm($seasonAverageData['ftm']);
        $seasonAverage->setReb($seasonAverageData['reb']);
        $seasonAverage->setStl($seasonAverageData['stl']);
        $seasonAverage->setBlk($seasonAverageData['blk']);
        $seasonAverage->setPlayerId($seasonAverageData['player_id']);
    }

    private function setTeamInfo(Team $team, mixed $teamData): void
    {
        $team->setId($teamData['id']);
        $team->setName($teamData['name']);
        $team->setFullName($teamData['full_name']);
        $team->setConference($teamData['conference']);
        $team->setCity($teamData['city']);
        $team->setAbbreviation($teamData['abbreviation']);
        $team->setDivision($teamData['division']);
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        $playerRepository = $this->entityManager->getRepository(Player::class);
        $randomPlayer = $this->famousPlayers[array_rand($this->famousPlayers)];
        $player = $this->getPlayerWithName($randomPlayer['first_name'], $randomPlayer['last_name'], $playerRepository);
        dump($player);

        $this->getSeasonAverageOfPlayer($player);
        return $player;
    }

    /**
     * @return Team[]|array
     */
    public function getTeams(): array
    {
        $teamsData = $this->teamService->getAllTeamData();
        $teamRepository = $this->entityManager->getRepository(Team::class);
        foreach ($teamsData as $teamData) {
            $team = $teamRepository->findOneBy(['id' => $teamData['id']]);

            if (!$team) {
                $team = new Team();
                $this->setTeamInfo($team, $teamData);
                $this->entityManager->persist($team);
            } else {
                $this->setTeamInfo($team, $teamData);
            }
        }

        $this->entityManager->flush();
        return $teamRepository->findAll();
    }

    private function createPopularPlayerArray() {
        $this->famousPlayers = [];
        $this->famousPlayers[] = ['first_name' => 'LeBron', 'last_name' => 'James'];
        $this->famousPlayers[] = ['first_name' => 'Stephen', 'last_name' => 'Curry'];
        $this->famousPlayers[] = ['first_name' => 'Luka', 'last_name' => 'Doncic'];
        $this->famousPlayers[] = ['first_name' => 'Kyrie', 'last_name' => 'Irving'];
        $this->famousPlayers[] = ['first_name' => 'Nikola', 'last_name' => 'Jokic'];
        $this->famousPlayers[] = ['first_name' => 'Anthony', 'last_name' => 'Davis'];
        $this->famousPlayers[] = ['first_name' => 'Giannis', 'last_name' => 'Antetokounmpo'];
        $this->famousPlayers[] = ['first_name' => 'Jayson', 'last_name' => 'Tatum'];
        $this->famousPlayers[] = ['first_name' => 'Kevin', 'last_name' => 'Durant'];
        $this->famousPlayers[] = ['first_name' => 'James', 'last_name' => 'Harden'];
        $this->famousPlayers[] = ['first_name' => 'Russell', 'last_name' => 'Westbrook'];
    }
}
