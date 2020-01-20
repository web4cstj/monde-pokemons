<?php
class Pokemon {
	static public function html_index() {
		$pdo = new PDO("sqlite:../pokemon.sqlite");
		$stmt = $pdo->prepare("SELECT id, numero, nom_fr FROM pokemons ORDER BY numero LIMIT 20");
		$stmt->execute();
		$resultat = '';
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
		$resultat .= '<div class="details">';
		if (($objPokemon = $stmt->fetchObject()) !== false) {
			$resultat .= '<h1>'.$objPokemon->nom_fr.'</h1>';
			$resultat .= '<div><img src="https://www.pokebip.com/pokedex-images/artworks/'.intval($objPokemon->numero).'.png" alt=""></div>';
			$resultat .= '</div>';
			$resultat .= '<div class="infos">';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Numéro</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->numero.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Nom français</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->nom_fr.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Nom anglais</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->nom_en.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Type(s)</span>';
			if ($objPokemon->type2) {
				$resultat .= '<span class="valeur">'.$objPokemon->type1.'/'.$objPokemon->type2.'</span>';
			} else {
				$resultat .= '<span class="valeur">'.$objPokemon->type1.'</span>';
			}
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Talents</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->talents.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Points de vie</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->pv.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Attaque</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->attaque.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Défense</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->defense.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Attaque spéciale</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->attaque_speciale.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Défense spéciale</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->defense_speciale.'</span>';
			$resultat .= '</div>';
			$resultat .= '<div class="donnee">';
			$resultat .= '<span class="etiquette">Vitesse</span>';
			$resultat .= '<span class="valeur">'.$objPokemon->vitesse.'</span>';
			$resultat .= '</div>';
		} else {
			$resultat .= '<h1>Ce Pokémon n\'existe pas</h1>';
		}
		$resultat .= '</div>';			
		return $resultat;
	}
}