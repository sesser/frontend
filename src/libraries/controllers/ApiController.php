<?php
class ApiController extends BaseController
{
  public static function photoDelete($id)
  {
    $status = Photo::delete($id);
    if($status)
      return self::success('Photo deleted successfully', $id);
    else
      return self::error('Photo deletion failure', false);
  }

  public static function photoDynamicUrl($id, $width, $height, $options = null)
  {
    return self::success('Url generated successfully', Photo::generateUrlInternal($id, $width, $height, $options));
  }

  /*public static function photoDynamic($id, $hash, $width, $height, $options = null)
  {
    $photo = Photo::generateImage($id, $hash, $width, $height, $options);
    return self::success('', $photo);
  }*/

  public static function photoUpload()
  {
    $status = Photo::upload($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);
    if($status)
      return self::success('yay', $status);
    else
      return self::error('File upload failure', false);
  }

  public static function photos()
  {
    $db = getDb();
    $photos = $db->getPhotos();
    return self::success('yay', $photos);
  }
}
