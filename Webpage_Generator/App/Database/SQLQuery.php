<?php
declare(strict_types=1);

namespace App\Database;

use PDO;

class SQLQuery
{
    protected object|null $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function saveDataToDB($rawData): void
    {
        $templateData = [':date' => date('Y-m-d H:i:s')];
        $templateItems = [];

        foreach ($rawData as $key => $value) {
            if (!str_contains($key, 'card')) {
                $templateData += array($key => $value);
                continue;
            }
            $templateItems += array($key => $value);
        }

        $query = 'INSERT INTO generated_templates (company_name, cover_img, main_title , sub_title, phone_number, location,about_info, type_of_goods_id, company_description,theme, linkedin_url, facebook_url, twitter_url, google_plus_url, date_created)
                  VALUES(:companyName, :coverImgURL, :pageTitle, :pageSubTitle, :phoneNumber, :location, :aboutYou, :typeOfGoods, :companyInfo, :theme, :linkedInSocial, :facebookSocial,:twitterSocial, :googleSocial, :date)';
        $statement = $this->connection->prepare($query);
        $statement->execute($templateData);

        $lastID = $this->connection->lastInsertId();
        $templateItems += array('templateID' => $lastID);

        $query = "INSERT INTO items_of_goods (item_url, item_description, template_id)
                  VALUES(:card1ImgURL,:card1Description, :templateID),
                        (:card2ImgURL,:card2Description, :templateID),
                        (:card3ImgURL,:card3Description, :templateID);";
        $statement = $this->connection->prepare($query);
        $statement->execute($templateItems);
        $_SESSION['userID'] = $lastID;

        Database::terminateConnection();
    }

    public function getTemplateData($id): array|null
    {
        $query = 'SELECT generated_templates.id, company_name, cover_img, main_title ,sub_title, phone_number, location, about_info, GOODS.type_of as type_of_goods, company_description, theme, linkedin_url, facebook_url, twitter_url, google_plus_url, date_created FROM generated_templates 
                    JOIN type_of_goods as GOODS
                    ON GOODS.id = generated_templates.type_of_goods_id
                    WHERE generated_templates.id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id, \PDO::PARAM_STR);
        $statement->execute();
        $getData = $statement->fetch(\PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $getData;
    }

    public function getTypesOfGoods(): array|null
    {
        $query = "SELECT * FROM type_of_goods;";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $data;
    }


    public function getCardItems($id): array|null
    {
        $query = 'SELECT item_url, item_description FROM items_of_goods WHERE template_id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id, \PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        Database::terminateConnection();
        return $data;
    }


//    EXTRA
    public function getAllTemplates()
    {
        $query = 'SELECT id, company_name, cover_img, phone_number, location, date_created FROM generated_templates';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
}