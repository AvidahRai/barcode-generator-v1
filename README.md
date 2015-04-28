# barcode-generator-v1

Barcode Generator is an one-page web-application, developed for generating barcodes from user input. Currently, it can generate five different symbologies of barcode:- UPC-A. UPC-E, EAN-8, EAN-13 and ISBN. The built-in PHP GD Library can create raster graphics which made it possible to generate the Barcodes.

Check out The live version is up and running in http://barcode-generator.avinashrai.com/ 

Check out the Design Document in http://avinashrai.com/Documentation/101/3.Design 

<h3> Setup Instructions </h3> 
This source code is for Local Environment only.

<ol>
  <li>Download the Application zip file and extract the folder.</li>
  <li>Copy the "barcode-generator-v1-master" in the XAMMPP's htdocs folder. Rename if desired.</li>
  <li>Open the "local.php" file in "barcode-generator-v1-master/barcodeGenerator/Config" with any text editors.</li>
  <li>Change the Constant Definition</li>
  <ol>
     <li>BASE_URI : The absolute path of the main folder.</li>
     <li>CACHE_URI : The absolute path of the "cache" folder.</li>
     <li>PUBLIC_URL : The url path of the "public_html" folder.</li>
     <li>CACHE_URL : The url path of the "cache" folder.</li>
  </ol>
  <li>Run XAMMPP Apache and enter the address where this stored.</li>
</ol>
