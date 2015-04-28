# barcode-generator-v1

Barcode Generator is an one-page web-application, developed for generating barcodes from user input. Currently, it can generate five different symbologies of barcode:- UPC-A. UPC-E, EAN-8, EAN-13 and ISBN. The built-in PHP GD Library can create raster graphics which made it possible to generate the Barcodes.

<h3> Setup Instructions </h3> 
This source code is for Local Environment only.

<ol>
  <li>Download the Application zip file and extract the folder.</li>
  <li>Copy the "barcode-generator-v1-master" folder in the XAMMPP's <strong>htdocs</strong> folder. Rename if desired.</li>
  <li>Open the "local.php" file in "barcode-generator-v1-master/barcodeGenerator/Config" with any text editors.</li>
  <li>* Change the Constant Definition values to fit your Folder placement. DONT CHANGE THE STRING NAME.*</li>
  <ol>
     <li>BASE_URI : The absolute path of the main folder. <br/>
     <i>E.g. C:\Program Files\XAMPP\htdocs\barcode-generator-v1-master\\</i>
     </li>
     <li>CACHE_URI : The absolute path of the "cache" folder. <br/>
     <i>E.g. C:\Program Files\XAMPP\htdocs\barcode-generator-v1-master\public_html\cache\\</i>
     </li>
     <li>PUBLIC_URL : The url path of the "public_html" folder. <br/>
     <i>E.g. http://localhost/barcode-generator-v1-master/public_html/</i>
     </li>
     <li>CACHE_URL : The url path of the "cache" folder.<br/>
     <i>E.g. http://localhost/barcode-generator-v1-master/public_html/</i>
     </li>
  </ol>
  <li>Run XAMMPP Apache and enter the URL address of the "public_html" folder on the browser.<br/> 
  <i>E.g. http://localhost/barcode-generator-v1-master/public_html/</i>
  </li>
</ol>

<h3>Links</h3>

Check out the live version at http://barcode-generator.avinashrai.com/ 

Check out the application Design Document at http://avinashrai.com/Documentation/101/3.Design 

Check out my Website: http://avinashrai.com/
