<?php
class Pokemon {
	static public function html_index() {
		$resultat = '';
		$pdo = new PDO("sqlite:../pokemon.sqlite");
		$stmt = $pdo->prepare("SELECT id, nom_fr, numero FROM pokemons ORDER BY numero LIMIT 10");
		$stmt->execute();
		$resultat .= '<div class="liste">';
		$resultat .= '<h1>Les Pokémons</h1>';
		$resultat .= '<table border="1">';
		$resultat .= '<thead>';
		$resultat .= '<tr>';
		$resultat .= '<th>No</th>';
		$resultat .= '<th>Icône</th>';
		$resultat .= '<th>Nom français</th>';
		$resultat .= '</tr>';
		$resultat .= '</thead>';
		$resultat .= '<tbody>';
		while (($objPokemon = $stmt->fetchObject()) !== false) {
			$resultat .= '<tr>';
			$resultat .= '<td>'.intval($objPokemon->numero).'</td>';
			$resultat .= '<td><img src="https://pokestrat.io/images/badges/'.intval($objPokemon->numero).'.png" alt="'.$objPokemon->nom_fr.'" style="width:64px; height:64px;"/></td>';
			$resultat .= '<td><a href="details.php?id='.$objPokemon->id.'">'.$objPokemon->nom_fr.'</a></td>';
			$resultat .= '</tr>';
		}
		$resultat .= '</tbody>';
		$resultat .= '</table>';
		$resultat .= '</div>';
		return $resultat;
	}
	static public function html_details($id) {
		$pdo = new PDO("sqlite:../pokemon.sqlite");
		$stmt = $pdo->prepare("SELECT id, numero, nom_fr, nom_en, type1, type2, talents, pv, attaque, defense, attaque_speciale, defense_speciale, vitesse FROM pokemons WHERE id=?");
		$stmt->execute([$id]);
		$resultat = '';
		if (($objPokemon = $stmt->fetchObject()) !== false) {
			$resultat .= '<div class="details">';
			$resultat .= '<h1>'.$objPokemon->nom_fr.'</h1>';
			$resultat .= '<div><img src="https://www.pokebip.com/pokedex-images/artworks/'.intval($objPokemon->numero).'.png" alt=""></div>';
			$resultat .= '</div>';
			$resultat .= '<table border="1">';
			$resultat .= '<tbody>';
			$resultat .= '<tr>';
			$resultat .= '<th>Numéro</th>';
			$resultat .= '<td>'.$objPokemon->numero.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Nom français</th>';
			$resultat .= '<td>'.$objPokemon->nom_fr.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Nom anglais</th>';
			$resultat .= '<td>'.$objPokemon->nom_en.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Type(s)</th>';
			if ($objPokemon->type2) {
				$resultat .= '<td>'.$objPokemon->type1.'/'.$objPokemon->type2.'</td>';
			} else {
				$resultat .= '<td>'.$objPokemon->type1.'</td>';
			}
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Talents</th>';
			$resultat .= '<td>'.$objPokemon->talents.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Points de vie</th>';
			$resultat .= '<td>'.$objPokemon->pv.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Attaque</th>';
			$resultat .= '<td>'.$objPokemon->attaque.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Défense</th>';
			$resultat .= '<td>'.$objPokemon->defense.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Attaque spéciale</th>';
			$resultat .= '<td>'.$objPokemon->attaque_speciale.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Défense spéciale</th>';
			$resultat .= '<td>'.$objPokemon->defense_speciale.'</td>';
			$resultat .= '</tr>';
			$resultat .= '<tr>';
			$resultat .= '<th>Vitesse</th>';
			$resultat .= '<td>'.$objPokemon->vitesse.'</td>';
			$resultat .= '</tr>';
			$resultat .= '</tbody>';
			$resultat .= '</table>';			
		}
		return $resultat;
	}
}