<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $sql = <<<SQL
            CREATE FUNCTION SKILL_PREREQ(value INT) RETURNS INT
            NOT DETERMINISTIC
            READS SQL DATA
            BEGIN


            DECLARE _id int;
            DECLARE _parent INT;
            DECLARE _attid INT;
            DECLARE _next INT;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET @id = NULL;

            SET _parent = @id;
            SET _id = -1;

            IF @id IS NULL THEN
                RETURN NULL;
            END IF;

            LOOP

            SELECT
            MIN(IFNULL(valueInt, valueFloat)) AS id, IF(MIN(IFNULL(valueInt, valueFloat)), CONCAT(@path, ',', _parent), @path), attributeID
            INTO @id, @path, _attid
            FROM `dgmTypeAttributes`
            WHERE
            typeID = _parent
            AND attributeID > 181
            AND attributeID < 185
            AND valueInt > _id;

            SET _attid = _attid +95;

            SELECT
                MIN(IFNULL(valueInt, valueFloat)) AS req
            INTO @req FROM
                `dgmTypeAttributes`
            WHERE
                typeID = _parent
                    AND attributeID = _attid;

            IF @id IS NOT NULL OR _parent = @start_with THEN
            SET @level = @level + 1;
            SET @parent = _parent;
            RETURN @id;
            END IF;

            IF @path = '' THEN
            RETURN NULL;

            END IF;
            SET @level := @level - 1;

            SELECT
                _parent,
                SUBSTRING_INDEX(@path, ',', - 1),
                SUBSTRING(@path,
                    1,
                    (LENGTH(@path) - (LENGTH(SUBSTRING_INDEX(@path, ',', - 1)) + 1)))
            INTO _id , _parent , @path;
            END LOOP;
            END
SQL;


        DB::connection('eve')->getPdo()->exec($sql);
    }
}
