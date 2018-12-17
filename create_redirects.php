<?php

/*
SELECT drupal_id, drupal_path, post_id FROM drupal_paths LEFT JOIN wp_pmxi_posts on unique_key = drupal_id
WHERE unique_key IS NOT NULL

Source URL, Target URL, [Regex 0=false, 1=true], [HTTP Code]

 */