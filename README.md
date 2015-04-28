# barcode-generator-v1

Barcode Generator is an one-page web-application, developed for generating barcodes from user input. Currently, it can generate five different symbologies of barcode:- UPC-A. UPC-E, EAN-8, EAN-13 and ISBN. The built-in PHP GD Library can create raster graphics which made it possible to generate the Barcodes.

Check out The live version is up and running in http://barcode-generator.avinashrai.com/ 

Check out the Design Document in http://avinashrai.com/Documentation/101/3.Design 

<h3> Setup Instructions </h3> 
This source code is for Local Environment only.

<ol>
  <li>Download the Application zip file and extract the folder.</li>
  <li>Copy the "barcode-generator-v1-master" folder in the XAMMPP's <strong>htdocs</strong> folder. Rename if desired.</li>
  <li>Open the "local.php" file in "barcode-generator-v1-master/barcodeGenerator/Config" with any text editors.</li>
  <li>* Change the Constant Definition values to fit your Folder placement. DONT CHANGE THE STRING NAME.*</li>
  <ol>
     <li>BASE_URI : The absolute path of the main folder. <br/>
     <small>E.g. C:\Program Files\XAMPP\htdocs\barcode-generator-v1-master\\</small>
     </li>
     <li>CACHE_URI : The absolute path of the "cache" folder. <br/>
     <small>E.g. C:\Program Files\XAMPP\htdocs\barcode-generator-v1-master\public_html\cache\\</small>
     </li>
     <li>PUBLIC_URL : The url path of the "public_html" folder. <br/>
     <small>E.g. http://localhost/barcode-generator-v1-master/public_html/</small>
     </li>
     <li>CACHE_URL : The url path of the "cache" folder.<br/>
     <small>E.g. http://localhost/barcode-generator-v1-master/public_html/</small>
     </li>
  </ol>
  <li>Run XAMMPP Apache and enter the URL address of the "public_html" folder on the browser.<br/> 
  <small>E.g. http://localhost/barcode-generator-v1-master/public_html/</small>
  </li>
</ol>
