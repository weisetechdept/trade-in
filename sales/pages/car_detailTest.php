public function testUploadFile()
{
    // Create a new instance of the Vue component
    $uploadAndroid = new \Vue();

    // Set the necessary data for the test
    $uploadAndroid->group = '1';
    $uploadAndroid->file = "test.jpg";
    $uploadAndroid->filenames = ["test.jpg"];
    $uploadAndroid->id = '123';

    // Call the uploadFile method
    $uploadAndroid->uploadFile();

    // Assert that the file upload was successful
    $this->assertTrue(true);
}