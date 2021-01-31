<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            "INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `parent_user_id`, `created_at`) VALUES
                    (1,	1,	1,	NULL,	now()),
                    (2,	2,	2,	1,	now()),
                    (3,	2,	3,	1,	now()),
                    (4,	2,	4,	1,	now()),
                    (5,	3,	5,	2,	now()),
                    (6,	3,	6,	2,	now()),
                    (7,	3,	7,	3,	now()),
                    (8,	3,	8,	4,	now()),
                    (9,	3,	9,	4,	now()),
                    (10,	3,	10,	4,	now()),
                    (11,	4,	11,	5,	now()),
                    (12,	4,	12,	5,	now()),
                    (13,	4,	13,	6,	now()),
                    (14,	4,	14,	6,	now()),
                    (15,	4,	15,	6,	now()),
                    (16,	4,	16,	7,	now()),
                    (17,	4,	17,	7,	now()),
                    (18,	4,	18,	8,	now()),
                    (19,	4,	19,	9,	now()),
                    (20,	4,	20,	10,	now()),
                    (21,	4,	21,	10,	now()),
                    (22,	4,	22,	10,	now()),
                    (23,	5,	23,	11,	now()),
                    (24,	5,	24,	11,	now()),
                    (25,	5,	25,	12,	now()),
                    (26,	5,	26,	12,	now()),
                    (27,	5,	27,	12,	now()),
                    (28,	5,	28,	15,	now()),
                    (29,	5,	29,	15,	now()),
                    (30,	5,	30,	16,	now()),
                    (31,	5,	31,	17,	now()),
                    (32,	5,	32,	18,	now()),
                    (33,	5,	33,	18,	now()),
                    (34,	5,	34,	19,	now()),
                    (35,	5,	35,	20,	now()),
                    (36,	5,	36,	21,	now()),
                    (37,	5,	37,	22,	now()),
                    (38,	5,	38,	22,	now()),
                    (39,	5,	39,	22,	now()),
                    (40,	6,	40,	23,	now()),
                    (41,	6,	41,	23,	now()),
                    (42,	6,	42,	25,	now()),
                    (43,	6,	43,	25,	now()),
                    (44,	6,	44,	25,	now()),
                    (45,	6,	45,	26,	now()),
                    (46,	6,	46,	26,	now()),
                    (47,	6,	47,	29,	now()),
                    (48,	6,	48,	30,	now()),
                    (49,	6,	49,	31,	now()),
                    (50,	6,	50,	31,	now()),
                    (51,	6,	51,	33,	now()),
                    (52,	6,	52,	33,	now()),
                    (53,	6,	53,	33,	now()),
                    (54,	6,	54,	36,	now()),
                    (55,	6,	55,	36,	now()),
                    (56,	6,	56,	36,	now()),
                    (57,	6,	57,	38,	now()),
                    (58,	6,	58,	38,	now()),
                    (59,	6,	59,	39,	now()),
                    (60,	6,	60,	39,	now()),
                    (61,	6,	61,	39,	now()),
                    (62,	6,	62,	39,	now()),
                    (63,	7,	63,	40,	now()),
                    (64,	7,	64,	40,	now()),
                    (65,	7,	65,	42,	now()),
                    (66,	7,	66,	42,	now()),
                    (67,	7,	67,	42,	now()),
                    (68,	7,	68,	45,	now()),
                    (69,	7,	69,	48,	now()),
                    (70,	7,	70,	48,	now()),
                    (71,	7,	71,	48,	now()),
                    (72,	7,	72,	48,	now()),
                    (73,	7,	73,	49,	now()),
                    (74,	7,	74,	49,	now()),
                    (75,	7,	75,	49,	now()),
                    (76,	7,	76,	52,	now()),
                    (77,	7,	77,	52,	now()),
                    (78,	7,	78,	52,	now()),
                    (79,	7,	79,	56,	now()),
                    (80,	7,	80,	56,	now()),
                    (81,	7,	81,	58,	now()),
                    (82,	7,	82,	58,	now()),
                    (83,	7,	83,	58,	now()),
                    (84,	7,	84,	58,	now()),
                    (85,	7,	85,	61,	now()),
                    (86,	7,	86,	61,	now()),
                    (87,	7,	87,	61,	now()),
                    (88,	7,	88,	61,	now())"
        );
    }
}