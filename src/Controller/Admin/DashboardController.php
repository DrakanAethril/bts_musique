<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\Admin\UsersCrudController;
use App\Entity\Instruments;
use App\Entity\LessonsSlots;
use App\Entity\LessonsDuration;
use App\Entity\Users;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UsersCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Musique');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', Users::class);
        yield MenuItem::linkToCrud('Instruments', 'fas fa-music', Instruments::class);
        yield MenuItem::linkToCrud('Lessons Slots', 'fas fa-calendar', LessonsSlots::class);
        yield MenuItem::linkToCrud('Lessons Duration', 'fas fa-clock', LessonsDuration::class);
    }
}
