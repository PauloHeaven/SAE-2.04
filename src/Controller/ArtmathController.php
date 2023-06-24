<?php

/**************************************************************
 * Site symfony : Art Mathématique - courbe de koch           *
 **************************************************************
 * (c) F. BONNARDOT, 28 Février 2022                          *
 * This code is given as is without warranty of any kind.     *
 * In no event shall the authors or copyright holder be liable*
 *    for any claim damages or other liability.               *
 **************************************************************/

namespace App\Controller;

// Inclus par défaut par Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\VonKoch;
use App\Entity\Nees;
use App\Entity\Johnson;
use App\Form\Type\VonKochType;
use App\Form\Type\NeesType;
use App\Form\Type\JohnsonType;

// Récupération des données d'un formulaire
use Symfony\Component\HttpFoundation\Request;

// Exécution d'un process (ici fonction python)
// Doc : https://symfony.com/doc/current/components/process.html
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

// Pour renvoyer un fichier directement
use Symfony\Component\HttpFoundation\File\File;


class ArtmathController extends AbstractController
{
    /**
     * @Route("/", name="racine")
     */
    public function racine() : Response
    {
        // Redirige vers /artmath si on va sur le site sans indiquer le nom de la route
        return $this->redirectToRoute('app_artmath');
    }

    /**
     * @Route("/artmath", name="app_artmath")
     */
    public function index(Request $request): Response
    {
        $koch = new VonKoch();
        $koch->setDimension(3);

        $formKoch = $this->createForm(VonKochType::class, $koch, [
            'attr' => ['id' => 'form_koch'],
            'action' => $this->generateUrl('calculerKoch')
        ]);

        $nees = new Nees();
        $nees->setAmplitude(0.5);
        $nees->setAngle(0.5);

        $formNees = $this->createForm(NeesType::class, $nees, [
            'attr' => ['id' => 'form_nees'],
            'action' => $this->generateUrl('calculerNees')
        ]);

        $johnson = new Johnson();
        $johnson->setColonnes(5);
        $johnson->setDecalage(0);
        $johnson->setEcart(50);
        $johnson->setAngle(12);
        $johnson->setAngledecoratif(0.005);
        $johnson->setRayondecoratif(0.4);
        $johnson->setDecalagedecoratif(10);

        $formJohnson = $this->createForm(JohnsonType::class, $johnson, [
            'attr' => ['id' => 'form_johnson'],
            'action' => $this->generateUrl('calculerJohnson')
        ]);

        return $this->render('artmath/index.html.twig', [
            'formKoch' => $formKoch,
            'formNees' => $formNees,
            'formJohnson' => $formJohnson
        ]);
    }

    /**
     * @Route("/calculerKoch", name="calculerKoch")
     */
    public function calculerKoch(Request $request): Response
    {
        // Récupère les paramètres issus du formulaire (on indique le champ name)
        $dimension = $request -> request -> all()['von_koch']['dimension'];

        // Oui : Appelle le script Python koch.py qui se trouve dans le répertoire /public
        $process = new Process(['python3','koch.py', $dimension]);
        $process -> run();
        // Récupère la valeur de retour renvoyée par le script Python, qui indique le nom du fichier
        $fichier=$process->getOutput();

        // Retourne un message si l'éxécution s'est mal passée
        if (!$process->isSuccessful())
            return new Response ("Erreur lors de l'exécution du script Python :<br>".$process->getErrorOutput());    

        $koch = new VonKoch();
        $koch->setDimension(3);

        $formKoch = $this->createForm(VonKochType::class, $koch, [
            'action' => $this->generateUrl('calculerKoch')
        ]);

        // A t'on appuyé sur calculer ?
        if (!isset($request -> request -> all()['von_koch']['imprimer']))
            return $this->render('artmath/koch.html.twig', [
                'fichier' => $fichier,
                'formKoch' => $formKoch
            ]);
        else {
            // On a appuyé sur imprimer
            return $this->render('artmath/imprimer.html.twig', [
                'fichier' => $fichier,
            ]);
        }
    }
    /**
     * @Route("/calculerNees", name="calculerNees")
     */
    public function calculerNees(Request $request): Response
    {
        // Récupère les paramètres issus du formulaire (on indique le champ name)
        $amplitude = $request->request->all()['nees']['amplitude'];
        $angle = $request->request->all()['nees']['angle'];
        $colonnes = $request->request->all()['nees']['colonnes'];
        $lignes = $request->request->all()['nees']['lignes'];

        // Appelle le script Python koch.py qui se trouve dans le répertoire /public
        $process = new Process(['python3','nees_carre.py', $amplitude, $angle, $colonnes, $lignes, "2>/dev/null"]);
        $process->run();
        $fichier='reponse.png';

        // Retourne un message si l'exécution s'est mal passée
        if (!$process->isSuccessful())
            return new Response ("Erreur lors de l'exécution du script Python :<br>".$process->getErrorOutput());

        $nees = new Nees();
        $nees->setAmplitude(0.5);
        $nees->setAngle(0.5);

        $formNees = $this->createForm(NeesType::class, $nees, [
            'action' => $this->generateUrl('calculerNees')
        ]);

        // A-t-on appuyé sur Calculer ?
        if (!isset($request -> request -> all()['nees']['imprimer']))
            return $this->render('artmath/nees.html.twig', [
                'fichier' => $fichier,
                'formNees' => $formNees
            ]);
        else {
            // On a appuyé sur Imprimer
            return $this->render('artmath/imprimer.html.twig', [
                'fichier' => $fichier,
            ]);
        }
    }
    /**
     * @Route("/calculerJohnson", name="calculerJohnson")
     */
    public function calculerJohnson(Request $request): Response
    {
        // Récupère les paramètres issus du formulaire (on indique le champ name)
        $colonnes = $request->request->all()['johnson']['colonnes'];
        $decalage = $request->request->all()['johnson']['decalage'];
        $ecart = $request->request->all()['johnson']['ecart'];
        $angle = $request->request->all()['johnson']['angle'];
        $angledecoratif = $request->request->all()['johnson']['angledecoratif'];
        $rayondecoratif = $request->request->all()['johnson']['rayondecoratif'];
        $decalagedecoratif = $request->request->all()['johnson']['decalagedecoratif'];
        if(!isset($request->request->all()['johnson']['couleursaleatoires'])) {
            $couleursaleatoires = 0;
        } else {
            $couleursaleatoires = 1;
        };
        $couleur1 = $request->request->all()['johnson']['couleur1'];
        $couleur2 = $request->request->all()['johnson']['couleur2'];
        $couleur3 = $request->request->all()['johnson']['couleur3'];
        $couleur4 = $request->request->all()['johnson']['couleur4'];
        $couleur5 = $request->request->all()['johnson']['couleur5'];

        // Appelle le script Python koch.py qui se trouve dans le répertoire /public
        $process = new Process(['python3','olivia_johnson_2018.py', $colonnes, $decalage, $ecart, $angle, $angledecoratif, $rayondecoratif, $decalagedecoratif, $couleursaleatoires, $couleur1, $couleur2, $couleur3, $couleur4, $couleur5]);
        $process->run();
        $fichier='reponse.png';

        // Retourne un message si l'exécution s'est mal passée
        if (!$process->isSuccessful())
            return new Response("Erreur lors de l'exécution du script Python :<br>".$process->getErrorOutput()."<br>".dump($request));

        $johnson = new Johnson();
        $johnson->setColonnes(5);
        $johnson->setDecalage(0);
        $johnson->setEcart(50);
        $johnson->setAngle(12);
        $johnson->setAngledecoratif(0.005);
        $johnson->setRayondecoratif(0.4);
        $johnson->setDecalagedecoratif(5);

        $formJohnson = $this->createForm(JohnsonType::class, $johnson, [
            'action' => $this->generateUrl('calculerJohnson')
        ]);

        // A-t-on appuyé sur Calculer ?
        if (!isset($request -> request -> all()['johnson']['imprimer']))
            return $this->render('artmath/johnson.html.twig', [
                'fichier' => $fichier,
                'formJohnson' => $formJohnson
            ]);
        else {
            // On a appuyé sur Imprimer
            return $this->render('artmath/imprimer.html.twig', [
                'fichier' => $fichier,
            ]);
        }
    }
}