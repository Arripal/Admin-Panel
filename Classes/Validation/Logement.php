<?php

namespace Classes\Validation;

use Traits\ValidationTrait;
use Respect\Validation\Validator as v;

class Logement
{
    use ValidationTrait;

    private const MIN_RATING = 0;
    private const MAX_RATING = 5;

    public function validate(array $logement_data)
    {

        $this
            ->pictures($logement_data['pictures'])
            ->cover($logement_data['cover'])
            ->description($logement_data['description'])
            ->rating($logement_data['rating'])
            ->location($logement_data['location'])
            ->title($logement_data['title'])
            ->email($logement_data['host'])
            ->equipments($logement_data['equipments']);

        return $this->validation->valid();
    }

    private function rating($value = self::MIN_RATING)
    {
        if (!v::intVal()->between(self::MIN_RATING, self::MAX_RATING)->validate($value)) {
            $this->validation->set_error('rating-value', 'La note n\'est pas valide, elle doit être comprise entre ' . self::MIN_RATING . ' et ' . self::MAX_RATING . '.');
        }
        return $this;
    }

    private function email($value)
    {

        $valid = $this->validation->email($value);
        if (!$valid) {
            $this->validation->set_error("error-host", "L'email est invalide.");
        }
        return $this;
    }

    private function title($value)
    {
        $valid = $this->validation->length($value);
        if (!$valid) {
            $this->validation->set_error("error-title", "Le titre est invalide.");
        }
        return $this;
    }

    private function description($value)
    {
        $valid = $this->validation->length($value);
        if (!$valid) {
            $this->validation->set_error("error-description", "La description est invalide.");
        }
        return $this;
    }

    private function location($value)
    {
        $valid = $this->validation->length($value);
        if (!$valid) {
            $this->validation->set_error("error-location", "La localisation est invalide.");
        }
        return $this;
    }

    private function cover($value)
    {
        $valid = $this->validation->url($value);
        if (!$valid) {
            $this->validation->set_error("error-cover", "L'URL est invalide.");
        }
        return $this;
    }

    private function equipments($equipments)
    {

        if ($equipments == null) {
            $this->validation->set_error("error-equipments", "Au moins un équipement doit être fourni.");
            return $this;
        }

        return $this;
    }

    private function pictures($pictures)
    {
        if ($pictures == null) {
            $this->validation->set_error("error-pictures", "Au moins une image doit être fourni.");
            return $this;
        }

        $valid = $this->validation->urls_array($pictures);

        if (!$valid) {
            $this->validation->set_error("error-pictures", "Vous devez fournir les urls des images a utiliser.");
        }
        return $this;
    }
}
