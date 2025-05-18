<?php
class EtudiantModel
{
    public function all()
    {


        return [
            [
                "id" => 1,
                "nom" => 'EVA',
                "promotion" => 'L3 MSI',
                "tel" => '0999394651'
            ],
            [
                "id" => 2,
                "nom" => 'DAVE',
                "promotion" => 'L3 GL',
                "tel" => '0999394652'
            ],
            [
                "id" => 3,
                "nom" => 'JESS',
                "promotion" => 'L3 MSI',
                "tel" => '0999394653'
            ],
            [
                "id" => 4,
                "nom" => 'DULCI',
                "promotion" => 'L3 MSI',
                "tel" => '0999394655'
            ],
            [
                "id" => 5,
                "nom" => 'GED',
                "promotion" => 'L3 MSI',
                "tel" => '0999394656'
            ],
            [
                "id" => 6,
                "nom" => 'ANNE',
                "promotion" => 'L3 GL',
                "tel" => '0999394657'
            ]
        ];
    }
    public function find($etudiant_id)
    {

        foreach ($this->all() as $etudiant) {
            if ($etudiant['id'] == $etudiant_id) {
                return $etudiant;
            }
        }
        return null;
    }
}
