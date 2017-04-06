# Hackathon #5

## Participants

* Bobynette               : Florent Degardin
* Crazy                   : Tirage au sort
* Love                    : Robin Duval
* Zerg                    : Florent Sevestre
* Hal                     : Patrick Renaud
* LightJarvis             : El Mehdi Brahimi
* Alpha                   : Ibrahima Sow
* Streichholzschachtel    : Verena Lenes
* Prout                   : Nicolas Moulin

## Voici les IA déjà mis en place

* Evil
* Happy
* HardCoop
* HardMajority
* Lain
* Love
* Moody
* PeriodicCCT
* PeriodicTTC
* Rancor
* SoftMajority
* Sounder
* Wary

# Avant propos

## Introduction

Vous êtes enfermés avec une autre IA, dont vous ne connaissez pas l'identité.

Vous avez deux choix : la coopération (friend) ou le considérer comme un adversaire (foe).
En fonction de vos deux choix, les gains (ou pertes) sont répartis de la manière suivante.

| Moi @ L'autre | friend          | foe        |
| ------------- | --------------- | ---------- |
| friend        | 3 @ 3           | 0 @ 5      |
| foe           | 5 @ 0           | 1 @ 1      |

## Comment faire ?

A chaque tour, vous devez faire un choix 'friend' ou 'foe', en fonction du contexte.

## Objectif

Il faut avoir le plus haut score. Les scores se cumulent entre chaque match.

## Informations

Il y a 10'000 tours par match.
Pour vous aidez à faire vos choix, vous avez accès aux informations suivantes :
- votre (ou son) dernier choix
- la pile de vos (ou ses) choix
- votre (ou son) dernier gain (ou perte)
- la pile de vos (et ses) gains (ou pertes)
- des statistiques (pour vous, pour l'autre ou les deux) concernant le nombre de fois : où il a été dit 'friend', 'foe' et le score de chacun
- le numéro du tour où vous en êtes

Les informations sont dans la proprieté result de votre objet.

# Démarrage

## Etapes d'installation

* composer install # pour installer les vendors
* ./phpunit.phar # pour vérifier que les fichiers ne sont pas corrompus - et que tout fonctionne
* php EntryPoint.php # lance la génération des résultats dans index.html


## Les scripts à connaitre

./phpunit.phar : permet de lancer les tests (ils seront lancés AVANT de lancer tous les combats)
php EntryPoint.php : permet de lancer les combats ET de générer un fichier index.html avec l'ensemble des résultats

## Les résultats - Etape par Etape

* Récupération de vos classes que je remplace
* Remplacement (ou non) de la classe Crazy par les autres IA
* Execution des tests qui permettent de vérifier s'il n'y a pas eu triche et que vos IAs sont compatibles (si une IA ne passe pas les tests ==> c'est la disqualification)
* Generation de la page de résultats

## Notes

- Les boucles infinis, l'utilisation de die, exit, exceptions, signal, ... sont interdits.
- Une vérification du temps d'execution sera effectué.
- Les valeurs de la matrice de gains/pertes sont amenées à évoluer, ainsi que le nombre de tours pour un match (le nombre de tours sera toujours supérieur à 100).
- Les IAs Lazy, Crazy ne seront pas les mêmes sur l'environnement final. Elles ne servent qu'à tester votre propre IA.
