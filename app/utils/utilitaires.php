<?php
if (!function_exists('afficherDate')) {
    function afficherDate($lang = "EN") {
        $jours = [
            "FR" => ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
            "EN" => ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "AR" => ["الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"]
        ];

        $mois = [
            "FR" => ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            "EN" => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "AR" => ["يناير", "فبراير", "مارس", "أبريل", "ماي", "يونيو", "يوليوز", "غشت", "شتنبر", "أكتوبر", "نونبر", "دجنبر"]
        ];

        $dateInfo = getdate();
        return sprintf("%s %d %s %d",
            $jours[$lang][$dateInfo['wday']],
            $dateInfo['mday'],
            $mois[$lang][$dateInfo['mon']-1],
            $dateInfo['year']
        );
    }
}
