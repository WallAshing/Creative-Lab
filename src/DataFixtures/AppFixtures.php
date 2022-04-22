<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Imprimante;
use App\Entity\Materiaux;
use App\Entity\Post;
use App\Entity\PostCateogies;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('Vauthier');
        $user->setPrenom('Alexandre');
        $user->setRoles([
            'ROLE_ADMIN',
            'ROLE_USER'
        ]);
        $user->setEmail('alexandre.vauthier@edu.devinci.fr');
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTime());
        $password = $this->hasher->hashPassword($user, 'test');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setName('Courquin');
        $user->setPrenom('Matteo');
        $user->setRoles([
            'ROLE_ADMIN',
            'ROLE_USER'
        ]);
        $user->setEmail('matteo.courquin@edu.devinci.fr');
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTime());
        $password = $this->hasher->hashPassword($user, 'test');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setName('Perrenot');
        $user->setPrenom('Louis');
        $user->setRoles([
            'ROLE_ADMIN',
            'ROLE_USER'
        ]);
        $user->setEmail('louis.perrenot@edu.devinci.fr');
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTime());
        $password = $this->hasher->hashPassword($user, 'test');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

        $user = $manager->getRepository(User::class);
        $user = $user->findAll();
        $categories = ['Tutoriels', 'Projets', 'Actualite Techno'];

        for ($i = 0; $i <= 2; $i++) {
            $postCategory = new PostCateogies();
            $postCategory->setName($categories[$i]);
            $manager->persist($postCategory);
        }
        $manager->flush();

        $postCategory = $manager->getRepository(PostCateogies::class);
        $postCategory = $postCategory->findAll();

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setUtilisateur($user[array_rand($user)]);
            $post->setTitle('iPhone 14 Pro et 14 Pro Max : on en sait plus sur les dimensions et le module photo qui dépasse');
            $post->setDescription("Des schémas des iPhone 14 Pro et iPhone 14 Pro Max dévoilent les dimensions supposées des futurs smartphones d'Apple. On en apprend également un peu plus sur la protubérance du bloc photo.");
            $post->setSecondDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. In auctor accumsan ante et egestas. Duis hendrerit venenatis ligula, molestie tempus urna venenatis vitae. Mauris ac luctus risus. Donec ultricies hendrerit mauris. Sed vestibulum in turpis commodo dictum. Donec tristique ornare felis, sit amet dictum nisi sollicitudin ac. Fusce ornare imperdiet nibh, a viverra est egestas at. Suspendisse consequat eget metus vitae feugiat. Nam commodo risus a malesuada sagittis. Mauris volutpat est purus, vitae hendrerit lorem fermentum id. Suspendisse sed tortor ultricies, eleifend nisl at, molestie arcu.");
            $post->setPicture('postBasePicture.png');
            $post->setCreatedAt(new \DateTime());
            $post->setCategory($postCategory[array_rand($postCategory)]);
            $post->setIsOnline(false);

            $manager->persist($post);
        }
        $manager->flush();

        $filament = ['PLA', 'PLA MAT', 'PLA GLOSSY', 'PLA BLING', 'PLA PANTONE', 'PLA METAL', 'PLA COPRODUIT', 'PET / PETG', 'ABS', 'Fibre de carbone'];
        $filamentDesc = [
            "Le filament PLA est l'une des matières premières phares pour la fabrication d'objets à l'aide d'une imprimante 3D personnelle ou de bureau à technologie FFF (Fused Filament Fabrication). Les références les plus appréciées des imprimeurs 3D sont le fil PLA 1.75 mm 1kg blanc et fil PLA 1.75 mm 1kg noir.",
            "Dans les applications esthétiques, l'utilisation du PLA mat permettra d'augmenter le réalisme. C'est par exemple le cas dans la production des modèles d'architecture.",
            "Donnez un nouvelle saveur à vos impressions PLA avec la gamme de filament PLA GLOSSY de chez dailyfil. Imprimez des pièces d'une brillance exceptionnelle et aux jeux de reflets époustouflants.",
            "Imprimez des pièces au rendu étincelant avec le PLA BLING, un filament fortement chargé en paillettes. Un rendu tout simplement sublime !",
            "Besoin d'une couleur de filament précise ? Vous êtes dans la bonne catégorie ! Retrouvez ici la gamme de filament PLA PANTONE®, un fil PLA respectant scrupuleusement la colorimétrie dictée par le célèbre nuancier PANTONE®. Le PANTONE® est une nuancier de couleur , au format papier, éprouvé et largement utilisé dans le monde du design.",
            "Voici notre gamme de filaments chargé en métal 1,75 mm pour imprimante 3D à plastique fondu. Le rendu métal ne se limite pas à la couleur, vos impressions seront plus denses et brillantes qu'avec du filament traditionnel. En effet l’alliage de plastique et de réelles particules de métal",
            "Valorisant les déchets de la restauration et de l'industrie, et ce localement.",
            "Le PET (polyethylene terephthalate) est un plastique de type polyester très courant qui est notamment utilisé dans la fabrication de bouteilles en plastique et d’emballages. Dans sa forme originelle le PET est difficile à imprimer, c’est pourquoi la plupart des filaments PET sont en fait des filaments PET-G : le PET est glycolisé.",
            "Le fil ABS (acrylonitrile butadiène styrène) est un thermoplastique très commun. On retrouve ce plastique dans un grand nombre d'objets de notre quotidien : ordinateurs, téléphones, automobile, etc.",
            "Alliez résistance et légèreté avec les filaments chargés en fibre de carbone. Il existe des filaments fibre de carbone sur base PLA avec les filaments Proto-Pasta ou encore sur base PET avec le XT-CF20 de chez Colorfabb."
        ];

        for ($i = 0; $i < 10; $i++) {
            $materiau = new Materiaux();
            $materiau->setName($filament[$i]);
            $materiau->setDescription($filamentDesc[$i]);
            $materiau->setQuantity(rand(0, 5000));
            $materiau->setCreatedAt(new \DateTime());
            $materiau->setUpdatedAt(new \DateTime());

            $manager->persist($materiau);
        }
        $manager->flush();

        $imprimantes = ['Creality 3D Ender-3', 'Creality Ender 3 Pro', 'Creality CR10'];

        for ($i = 0; $i < 15; $i++) {
            $imprimante = new Imprimante();
            $imprimante->setName($imprimantes[array_rand($imprimantes)]);
            $imprimante->setTime(new \DateTime());
            $imprimante->setWorking(false);
            $imprimante->setCreatedAt(new \DateTime());
            $manager->persist($imprimante);
        }
        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $datetime = new \DateTime();
            $datetime->modify("+ $i day");
            $event = new Event();
            $event->setName("JPO");
            $event->setDate($datetime);
            $event->setPicture('postBasePicture.png');
            $event->setDescription("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod");
            $manager->persist($event);
        }
        $manager->flush();



    }
}
