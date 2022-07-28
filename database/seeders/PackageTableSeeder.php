<?php 
use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Database\Seeder; 
class PackageTableSeeder extends Seeder { 
	public function run() { 
    	Package::create([ 
        	'title' => "MEMBRE DU BUREAU", 
            'type' => PackageType::$type['ILLIMITE'],
            'resume' => 'Les responsables de l\'association'
        ]);
        Package::create([
        	'title' => "GAVIAL", 
            'resume' => 'Pas d\'emprunt
            Participant aux soirées jeux.
            Une seule personne.',
            'count' => 0,
            'price' => 5,
        ]); 
        Package::create([
        	'title' => "CAÏMAN", 
            'resume' => 'Pas d\'emprunt
            Participant aux soirées jeux.
            Pour les familles.',
            'count' => 0,
            'price' => 10,
        ]); 
        Package::create([
        	'title' => "CROCO", 
            'type' => PackageType::$type['MOIS'],
            'resume' => 'Un emprunt par mois',
            'count' => 1,
            'price' => 30,
        ]); 
        Package::create([
        	'title' => "ALLIGATOR", 
            'type' => PackageType::$type['SEMAINE'],
            'resume' => 'Deux emprunts par semaine',
            'count' => 2,
            'price' => 80,
        ]); 
    }    
}