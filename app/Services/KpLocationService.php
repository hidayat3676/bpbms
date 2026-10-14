<?php

namespace App\Services;

/**
 * Class KpLocationService
 *
 * Single Responsibility: Khyber Pakhtunkhwa (KP) Administrative Locations
 * Provides districts and tehsils mapping for BPBMS.
 */
class KpLocationService
{
    /**
     * Map of Khyber Pakhtunkhwa Districts and their corresponding Tehsils.
     *
     * @var array<string, array<string>>
     */
    protected array $districtTehsilMap = [
        'Abbottabad' => ['Abbottabad', 'Havelian', 'Lora', 'Lower Tanawal'],
        'Bajaur' => ['Khar', 'Nawagai', 'Barang', 'Salarzai', 'Utmankhel', 'Mamund', 'Chamarkand'],
        'Bannu' => ['Bannu', 'Domel', 'Baka Khel', 'Kakki', 'Miryan', 'Wazir'],
        'Batagram' => ['Batagram', 'Allai'],
        'Buner' => ['Daggar', 'Gagra', 'Khadukhal', 'Mandanr', 'Chagharzai', 'Gadezai'],
        'Charsadda' => ['Charsadda', 'Tangi', 'Shabqadar'],
        'Chitral Lower' => ['Chitral', 'Drosh', 'Lotkoh', 'Ayun'],
        'Chitral Upper' => ['Mastuj', 'Mulkhow', 'Torkhow', 'Buni'],
        'Dera Ismail Khan' => ['D.I. Khan', 'Kulachi', 'Daraban', 'Paharpur', 'Paroa', 'Paniala'],
        'Dir Lower' => ['Timergara', 'Balambat', 'Lal Qila (Maidan)', 'Samarbagh', 'Munda', 'Khall', 'Adenzai'],
        'Dir Upper' => ['Dir', 'Sharingal', 'Kalkot', 'Wari', 'Larjam', 'Barawal'],
        'Hangu' => ['Hangu', 'Thall'],
        'Haripur' => ['Haripur', 'Ghazi', 'Khanpur'],
        'Karak' => ['Karak', 'Banda Daud Shah', 'Takht-e-Nasrati'],
        'Khyber' => ['Bara', 'Jamrud', 'Landi Kotal', 'Mula Gori'],
        'Kohat' => ['Kohat', 'Lachi', 'Gumbat', 'Dara Adam Khel'],
        'Kolai-Palas' => ['Palas', 'Kolai', 'Batupera'],
        'Kurram' => ['Upper Kurram', 'Lower Kurram', 'Central Kurram'],
        'Lakki Marwat' => ['Lakki Marwat', 'Naurang', 'Betani', 'Ghazni Khel'],
        'Lower Kohistan' => ['Pattan', 'Bankad'],
        'Malakand' => ['Batkhela', 'Dargai', 'Sam Ranizai'],
        'Mansehra' => ['Mansehra', 'Balakot', 'Oghi', 'Baffa Pakhal', 'Darband'],
        'Mardan' => ['Mardan', 'Takht Bhai', 'Katlang', 'Rustam', 'Garhi Kapura'],
        'Mohmand' => ['Halimzai', 'Pandyali', 'Prang Ghar', 'Safi', 'Upper Mohmand', 'Baizai', 'Ambar'],
        'North Waziristan' => ['Miran Shah', 'Mir Ali', 'Razmak', 'Datta Khel', 'Spinwam', 'Dossali', 'Garyum', 'Ghulam Khan', 'Shewa'],
        'Nowshera' => ['Nowshera', 'Pabbi', 'Jehangira'],
        'Orakzai' => ['Lower Orakzai', 'Upper Orakzai', 'Central Orakzai', 'Ismailzai'],
        'Peshawar' => ['Peshawar City', 'Shah Alam', 'Mathra', 'Chamkani', 'Badaber'],
        'Shangla' => ['Alpuri', 'Besham', 'Chakesar', 'Martung', 'Puran', 'Balo Khan'],
        'South Waziristan Lower' => ['Wana', 'Shakai', 'Birmil', 'Toi Khulla'],
        'South Waziristan Upper' => ['Makin', 'Ladha', 'Sararogha', 'Tiarza', 'Shawal', 'Shakoi'],
        'Swabi' => ['Swabi', 'Topi', 'Lahor', 'Razar'],
        'Swat' => ['Babuzai', 'Barikot', 'Kabal', 'Matta', 'Khwazakhela', 'Madyan', 'Bahrain', 'Charbagh'],
        'Tank' => ['Tank', 'Jandola'],
        'Torghar' => ['Judba', 'Khander', 'Hassanzai'],
        'Upper Kohistan' => ['Dasu', 'Kandia', 'Harban Basha'],
    ];

    /**
     * Get all KP Districts sorted alphabetically.
     *
     * @return array<string>
     */
    public function getDistricts(): array
    {
        $districts = array_keys($this->districtTehsilMap);
        sort($districts);

        return $districts;
    }

    /**
     * Get all Tehsils for a specific KP District.
     *
     * @param string $district
     * @return array<string>
     */
    public function getTehsilsByDistrict(string $district): array
    {
        return $this->districtTehsilMap[$district] ?? [];
    }

    /**
     * Get full map of districts to tehsils.
     *
     * @return array<string, array<string>>
     */
    public function getAllDistrictsWithTehsils(): array
    {
        ksort($this->districtTehsilMap);

        return $this->districtTehsilMap;
    }

    /**
     * Validate whether a district exists in KP.
     */
    public function isValidDistrict(string $district): bool
    {
        return array_key_exists($district, $this->districtTehsilMap);
    }

    /**
     * Validate whether a tehsil exists in the given district.
     */
    public function isValidTehsil(string $district, string $tehsil): bool
    {
        if (!$this->isValidDistrict($district)) {
            return false;
        }

        return in_array($tehsil, $this->districtTehsilMap[$district], true);
    }
}
