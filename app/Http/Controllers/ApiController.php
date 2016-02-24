<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getSkills()
    {
        $result = DB::connection('eve')->select(
            'SELECT
              t.typeID as id,
              t.typeName AS text ,

              (SELECT attributeName
               FROM dgmAttributeTypes AS d2
               WHERE d2.attributeID=
                   (SELECT IFNULL(valueInt, valueFloat)
                    FROM dgmTypeAttributes AS d
                    WHERE d.typeID=t.typeID
                      AND d.attributeID=180)) AS PirmaryAttribute ,

              (SELECT attributeName
               FROM dgmAttributeTypes AS d2
               WHERE d2.attributeID=
                   (SELECT IFNULL(valueInt, valueFloat)
                    FROM dgmTypeAttributes AS d
                    WHERE d.typeID=t.typeID
                      AND d.attributeID=181)) AS SecondaryAttribute ,

              (SELECT IFNULL(valueInt, valueFloat)
               FROM dgmTypeAttributes AS d
               WHERE d.typeID=t.typeID
                 AND d.attributeID=275) AS Multiplier

            FROM invTypes AS t

            LEFT JOIN invGroups AS g ON g.groupID = t.groupID
            LEFT JOIN invCategories AS c ON c.categoryID = g.categoryID

            WHERE g.categoryID = 16
              AND t.marketGroupID IS NOT NULL

            ORDER BY groupName,
                     typeName'
        );

        return response()->json($result);
    }

    public function getPrerequisits($id)
    {

        if (!is_numeric($id)) {
            return response()->json([]);
        }

        $result = DB::connection('eve')->select(
            '
                                    SELECT output.*, invTypes.typeName
                                        FROM(
                                        SELECT SKILL_PREREQ(dgmTypeAttributes.typeID) AS id, @level AS level, @req AS req
                                        FROM (
                                        SELECT
                                        @start_with := '. $id.',
                                        @id := @start_with,
                                        @level := 0,
                                        @parent := 0,
                                        @path := \'\',
                                        @req := \'\'
                                        ) vars, dgmTypeAttributes
                                        WHERE @id IS NOT NULL
                                        ) output
                                        INNER JOIN invTypes ON output.id = invTypes.typeID
                                        '
        );

        return response()->json($result);
    }
}