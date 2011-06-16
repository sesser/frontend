<?php
class DatabaseProviderSimpleDb implements DatabaseInterface
{
  private $domain;
  public function __construct($opts)
  {
    $this->db = new AmazonSDB($opts->awsKey, $opts->awsSecret);
    $this->domain = getConfig()->get('aws')->domain;
  }

  public function deletePhoto($id)
  {
    $res = $this->db->delete_attributes($this->domain, $id);
    return $res;
  }

  public function getPhoto($id)
  {
    $res = $this->db->select("select * from {$this->domain} where itemName()='{$id}'");
    return self::normalizePhoto($res->body->SelectResult->Item);
  }

  public function getPhotos()
  {
    $res = $this->db->select("select * from {$this->domain}");

    $photos = array();
    foreach($res->body->SelectResult->Item as $photo)
    {
      $photos[] = $this->normalizePhoto($photo);
    }
    return $photos;
  }

  public function putPhoto($id, $params)
  {
    $res = $this->db->put_attributes($this->domain, $id, $params);
    return $res;
  }

  private function normalizePhoto($raw)
  {
    $id = strval($raw->Name);
    $data = array();
    foreach($raw->Attribute as $item)
    {
      $name = (string)$item->Name;
      $value = (string)$item->Value;
      $photo[$name] = $value;
    }
    return Photo::normalize($id, $photo);
  }
}
