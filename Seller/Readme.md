# Magento 2

## Module Creation :
Steps to create a Simple Module:
1.  Create a vendor Directory (Dhruvi)
    
2.  In the Vendor Directory, create a directory with the Module name.
    
3.  Example  : Dhruvi/Vendor
    
4.  Create module.xml in directory Dhruvi/Vendor/etc/
    
5.  Example  : Dhruvi/Vendor/etc/module.xml
    
		<?xml version="1.0" encoding="UTF-8"?>
		<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
			<module name="Dhruvi_Vendor" />
		</config>
6.  Create registration.php in directory 
		
		Dhruvi\Vendor\etc\
    
8.  Example  :
			
		Dhruvi\Vendor\etc\registation.php
    
	=> This will register our module.

		<?xml version="1.0" encoding="UTF-8"?>
		<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
			<module name="Dhruvi_Vendor" />
		</config>
9.  Enabling the Module.
    Run 
	
		sudo bin/magento setup:upgrade && sudo chmod -R 777 var/ generated/ pub/ 
	This will enable your module and can see our module in the list.

## Route Creation :
		We will create a route for every module to let controller and action work.
		
	1.  In etc/ Create a new directory frontend.
	    
	2.  Create routes.xml in frontend as it is a frontend route.
	    
	3.  In frontend, route id=standard.
	    
	4.  Route will be the first part of our url after localhost.
	    
	5.  Here, vendor is the route.
	    
	6.  Example : Dhruvi\Vendor\etc\frontend\routes.xml
    
	<?xml version="1.0" encoding="UTF-8"?>
	<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
		<router id="standard">
			<route id="vendor" frontName="vendor">
				<module name="Dhruvi_Vendor" />
			</route>
		</router>
	</config>

## Controller Creation :
1.  Create routes.xml as mentioned in the Route Creation.
    
2.  We have to create a Controller in order to render a new page in the module or for table creation or any other purposes.
    
3.  Create a Controller Directory inside Module i.e.., Vendor.
    
4.  Create Index(Action) directory inside Controller inside which we create Index.php
    
5.  Example : 
	
		Dhruvi\Vendor\Controller\Index\Index.php
    
		<?php
		namespace Dhruvi\Vendor\Controller\Index;
		use Magento\Framework\App\Action\Action;
		use Magento\Framework\Controller\ResultFactory;
		class Index extends Action {
			public function execute()
			{ 
				$this->_view->getPage()->getConfig()->getTitle()->set(__("Registered People are"));
				return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
			}
		}
	=> All controllers should be extended with Action class which calls execute() in class Index(Action).
	=> In execute we write the controller logic and will return response for the request.
	=>Here in function execute we are creating a new page using resultFactory with TYPE_PAGE.
  
## View, Block, Layout Creation :
		Anything we want to display in the page is created here.
	
	1.  Create a view Directory inside the Module(Dhruvi).
	    
	2.  In view folder, Create a frontend directory(This contains all the view files of frontend).
	    
	3.  In the frontend folder, Create a folder with name templates which contains all the phtml files (or) the files to be shown on frontend.
	    
	4.  For example, let us create a form to enter the vendor details.
	    
	5.  To create form, Create a phtml file.
	    
	6.  Example : Dhruvi\Vendor\view\frontend\templates\list.phtml
    
	<?php
	/**
	 * @var $block \BlockClass
	 */
	?>
	
	<form action="<?= $block->getPostUrl() ?>" method="POST">
		<fieldset>
			<div>
				<label for="name">Name : </label>
				<input type="text" name="name"/>
			</div>
			<input type="submit" name="submit" value="submit"/>
		</fieldset>
	</form>
	
	=>Likewise, add other fields such as DOB,Email,Address etc..
7.  Next step is to Create a Block class for this template.
    
8.  Create a Block folder inside the Module(Vendor) Folder.
    
9.  Create a file Information.php in the Block.
    
10.  This extends the Template class.
    
11.  Example : Dhruvi\Vendor\Block\Information.php
    
	<?php
	namespace Dhruvi\HelloWorld\Block;
	use Magento\Framework\View\Element\Template;
	class Helloworld extends Template {
		public function getText() {
			return "Hi..!! Welcome to the Module";
		}
	}
=> We can call this function inside the templates.
12.  Example : Dhruvi\Vendor\view\frontend\templates\list.phtml
	
	<?php 
	/**
	  * @var $block \BlockClassWithNamespace
	  */
	?>    
	<?php $vendors = $block->getText(); ?>
	<form action="<?= $block->getPostUrl() ?>" method="POST">
		<fieldset>
			<div>
				<label for="name">Name : </label>
				<input type="text" name="name"/>
			</div>
			<input type="submit" name="submit" value="submit"/>
		</fieldset>
	</form>
13.  To display it in the module, we have to create a layout file.
    
14.  Create a layout folder in view/frontend.
    
15.  Create route_controller_action.xml as layout filename.
    
16.  Example : Dhruvi\Vendor\view\frontend\layout\vendor_index_index.xml.
    
	<?xml version="1.0" encoding="UTF-8"?>
	<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	layout="1column"
	xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/layout_generic.xsd">
		<body>
			<referenceContainer name="content">
				<block class="Dhruvi\Vendor\Block\Information" name="vendor.list" template="Dhruvi_Vendor::list.phtml" />
			</referenceContainer>
		</body>
	</page>
	
	=>This will add block which contains list.phtml to the page content.
17.  Run cache command sudo bin/magento ca:cl && sudo chmod -R 777 var/ generated/ pub/ # in terminal
    
18.  Next run sudo bin/magento setup:upgrade && sudo chmod -R 777 var/ generated/ pub/ # in terminal
    
19.  Hit the url to see the output=> vendor/index/index.
    
  
![](https://lh6.googleusercontent.com/oxvIYYaaNJfjN2QvRiatJnqdLPtKWHqMJr51I1uTUw2uzqJ0sfsgNoJmtVj5RkKxxbDR19C8U_buxh2Ti6liWkdGW29oE2M5DFbzUTb8tvYlNGQDNO-xF4t45bNP1E65avl7cel7)
Figure : Form to Enter Details.
  
## Backend Route Creation :
1.  Create routes.xml in adminhtml as it is a backend route.
    
2.  Create adminhtml in the etc folder.
    
3.  Route will be the first part of our url after localhost.
    
4.  In backend, route id=admin.
    
Example : Dhruvi\Vendor\etc\adminhtml\routes.xml

	<?xml version="1.0"?>
	<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
		<router id="admin">
			<route id="vendor" frontName="vendor">
				<module name="Dhruvi_Vendor"/>
			</route>
		</router>
	</config>
5.  Route id in frontend is Standard where as in backend is admin.
    
  
## Menu Creation :
1.  Register the module. Create registration.php as mentioned in Module  Creation
    
2.  Configure Module=> create file module.xml as mentioned in Module creation
    
3.  Create file menu.xml in the etc/adminhtml/
    
4.  Copy the content from magento/module-cms/etc/adminhtml/menu.xml
    
	=>Change the action with your route/controller/action,title and module.
Id and resource should be same.
Example :
	
		Dhruvi\Vendor\etc\adminhtml\menu.xml

		<?xml version="1.0"?>
		<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Backend:etc/menu.xsd">
			<menu>
				<add id="Dhruvi_Vendor::vendor" title="Vendor" module="Dhruvi_Vendor" sortOrder="51" resource="Dhruvi_Vendor::vendor"/>
				<add id="Dhruvi_Vendor::vendors" title="All Vendors" module="Dhruvi_Vendor" sortOrder="10" action="vendor/vendor/index" resource="Dhruvi_Vendor::vendor" parent="Dhruvi_Vendor::vendor"/>
			</menu>
		</config>
	
5.  To Create a sub menu add parent field in the add tag as mentioned in the above snippet.
    
	=>Here, we have created Menu item in the main menu called as Vendor in the Main menu title inside which there is child menu/sub menu called as All Vendors.
6.  Run 
	
		sudo bin/magento setup:upgrade && sudo chmod -R 777 var/ generated/ pub/ # (or) Cache:clean in terminal
    
7.  In the admin part of magento=>Menu will be displayed.
    
  
![](https://lh3.googleusercontent.com/pKQGU10aeUxHtiG7QIT068FZY_zU8Rsw8KJnH2CMkgZMC2GQNkw1oa6GXghiXsylA_H_JnrsoO5Kos447FYdDzf6FQ8tlc_ZzQhgeFdpdzvzm7-Bv_mh_CpqgCeCRZvCxGr2WBoy)
Figure : Menu and Sub Menu
  
## System Configuration :
1.  Create system.xml in path etc/adminhtml
    
2.  Example : Dhruvi\Vendor\etc\adminhtml\system.xml
    
		<?xml version="1.0"?>
		<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		    xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Config:etc/system_file.xsd">
		    <system>
		        <tab id="dhruvi" translate="label" sortOrder="10">
		            <label>Dhruvi</label>
		        </tab>
		        <section id="vendor" translate="label" sortOrder="130" showInDefault="1" showInWebsite="1" showInStore="1">
		            <class>separator-top</class>
		            <label>Vendor</label>
		            <tab>dhruvi</tab>
		            <resource>Dhruvi_Vendor::vendor_config</resource>
		            <group id="general" translate="label" type="text" sortOrder="10" showInDefault="1" showInWebsite="0"
		                showInStore="0">
		                <label>General Configuration</label>
		                <field id="enable" translate="label" type="select" sortOrder="1" showInDefault="1" showInWebsite="0"
		                    showInStore="0">
		                    <label>Module Enable</label>
		                    <source_model>Magento\Config\Model\Config\Source\Yesno</source_model>
		                </field>
		                <field id="display_text" translate="label" type="text" sortOrder="1" showInDefault="1" showInWebsite="0"
		                    showInStore="0">
		                    <label>Display Text</label>
		                    <comment>This text will display on the frontend.</comment>
		                </field>
		            </group>
		        </section>
		    </system>
		</config>
3.  Set Default Value :
    
=>This value will be saved by default.
=> Create config.xml in etc/
Example : Dhruvi/Vendor/etc/config.xml

    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Store:etc/config.xsd">
        <default>
            <registration>
                <general>
                    <enable>1</enable>
                    <display_text>Vendor Module</display_text>
                </general>
            </registration>
        </default>
    </config>
4.  Cache clean : and run the admin part (magento24.local/admin)!!
    
![](https://lh6.googleusercontent.com/B2IFhAXwqTBagxVo0xEiAjgPoPTiNzgThJfQ5zNUBMPQPdMinn_dU3IGx-LstttufCl1YiQ8MuUwi6j3T1b75WWXcGZ62YeVkdkAVSqAPbCcTYy0h7XgHs_aIqBhvWPXbKPRgjWY)
Figure : System Configuration
  
## Ui Component :
1.  If we want to include table listing as menu action we can create di.xml in etc/
    
2.  Copy from module-catalog/etc/di.xml
    
=>change the collection with collection created in resource model.
=>add virtual type with arguments and change name with our grid collection path, name of the table and resourceModel.
3.  Example : Dhruvi/Vendor/etc/di.xml
    

    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
        <virtualType name="Dhruvi\Vendor\Model\ResourceModel\Vendor\Grid\Collection"
            type="Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult">
            <arguments>
                <argument name="mainTable" xsi:type="string">dhruvi_vendor</argument>
                <argument name="resourceModel" xsi:type="string">Dhruvi\Vendor\Model\ResourceModel\Vendor</argument>
            </arguments>
        </virtualType>
        <type name="Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory">
            <arguments>
                <argument name="collections" xsi:type="array">
                    <item name="vendor_vendor_listing_data_source" xsi:type="string">
                        Dhruvi\Vendor\Model\ResourceModel\Vendor\Grid\Collection</item>
                </argument>
            </arguments>
        </type>
    </config>
	
	Here, Model/ResourceModel/Book/Grid/Collection is to refer to table dhruvi_vendor.
To get the data from the table, Follow these steps-
4.  Create db_schema.xml to create table in database in \etc\adminhtml\
    
Example : Dhruvi\Vendor\etc\adminhtml\db_schema.xml

    <?xml version="1.0" encoding="UTF-8"?>
    <schema xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:Setup/Declaration/Schema/etc/schema.xsd">
        <table name="dhruvi_vendor" resource="default" engine="innodb" comment="table to store firearm information">
            <column xsi:type="int" name="id" padding="10" unsigned="true" nullable="false" identity="true" comment=" ID" />
            <column xsi:type="varchar" name="name" nullable="false" length="50" comment="Registered Name" />
            <constraint xsi:type="primary" referenceId="PRIMARY">
                <column name="id" />
            </constraint>
        </table>
    </schema>
  
5.  Now Create Collection.php in Dhruvi\Vendor\Model\ResourceModel\Grid.
    
=>copy from magento/module-

	cms/Model/ResourceModel/Grid/Collection.php
=>change namespaces, classname.
Example : 
		
	Dhruvi\Vendor\Model\ResourceModel\Grid\Collection.php
6.  Also Create files Model,ResourceModel and Collections.
    
  
## Model :
7.  Models are used to do data Operations such as Create, Read, Update and Delete on the Databases.
    
8.  In magento, Model is divide into three parts- models,resource models and collection.
    
9.  Every model extends the Magento\Framework\Model\AbstractModel Class.
    
10.  Create a Model folder in Vendor(Module) Vendor/Model/
    
11.  In the Model folder, Create a class file Vendor.php
    
12.  Example : Dhruvi/Vendor/Model/Vendor.php
    
	    <?php
	    namespace Dhruvi\Vendor\Model;
	    use Magento\Framework\Model\AbstractModel;
	    class Vendor extends AbstractModel {
	        protected function _construct() {
	            $this ->_init(\Dhruvi\Vendor\Model\ResourceModel\Vendor::class);
	        }
	    }
=>Here, init method() takes resource model class as param.
## Resource Model :
13.  Every Model has a Resource Model.
    
14.  All the resource models must extend 
	
		 Magento\Framework\Model\ResourceModel\Db\AbstractDbclass.
    
15.  Create a class file(Vendor.php) in Dhruvi/Vendor/Model/ResourceModel
    
16.  Example : Dhruvi/Vendor/Model/ResourceModel/Vendor.php
    
	<?php
	namespace Dhruvi\Vendor\Model\ResourceModel;
	use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
	class Vendor extends AbstractDb {
		protected function _construct() {
			$this->_init('dhruvi_vendor', 'id');
		}
	}

	=>Here, we call the init method() and pass two params i.e.., table_name,primary_id.
  
## Collection :
1.  Create a Vendor folder in the ResourceModel=>ResourceModel/Vendor.
    
2.  Now create a Collection class =>Model/ResourceModel/Vendor/Collection.php
    
3.  Example : Dhruvi/Vendor/Model/ResourceModel/Collection.php
    
    
		<?php
		Namespace Dhruvi\Vendor\Model\ResourceModel\Vendor;

		use Dhruvi\Vendor\Model\Vendor;
		use Dhruvi\Vendor\Model\ResourceModel\Vendor as ResourceModelVendor;
		use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

		class Collection extends AbstractCollection {
		    protected function _construct() {
		        $this->_init(Vendor::class, ResourceModelVendor::class);
		    }
		}
=>Collections must inherit 

	Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection.
	
	=>Here, init () Passes 2 arguments(Modelclass, ResourceModelclass).
  
7.  Create vendor_vendor_index.xml i.e., route_controller_action.xml in 	
	
		Dhruvi\Vendor\view\adminhtml\layout\route_controller_action.xml
    
	=>ui component is defined here.
	Example :
		`Dhruvi\Vendor\view\adminhtml\layout\vendor_vendor_index.xml`
		
		<?xml version="1.0" encoding="UTF-8"?>
		<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		    xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
		    <update handle="styles" />

		    <body>
		        <referenceContainer name="content">
		            <uiComponent name="vendor_vendor_listing" />
		        </referenceContainer>
		    </body>
		</page>
  
8.  Create vendor_vendor_listing.xml i.e., uiComponent name in “vendor_vendor_index.xml”.
    
9.  In admin html create ui_component=>Dhruvi\Vendor\view\adminhtml\ui_component\
    
Example : `Dhruvi\Vendor\view\adminhtml\ui_component\vendor_vendor_listing.xml`
=>Copy the file from `module_cms/view/adminhtml/ui_component/cms_page_listing.xml`
=>change the filename and also data source by selecting the name
` Copy that(ctrl+c), search(ctrl+F), replace(ctrl+R)`
=>change primary id,column names as per your table, remove enable and disable.
=>This file includes all the buttons to perform actions and all the fields which are in the form are been defined in individual column using `<column></column>`
10.  Run cache clean => In submenu->A page containing Vendor details will be displayed.
    
  
![](https://lh3.googleusercontent.com/sGbPvmznS6NO2TDaNNiDPxW9mmB7rTE2xysSHX6kzDjCsYiriuA805bfFl5N_mf9C6r3-7umBCS8nCKBae1t9qax6ZpwEFaX9OLUZLratyNvbyzFq5tU0Dw6XCAV_SIfufdfe3eR)
Figure : Vendor Details
11.  To add a new Vendor =>
    
=>In vendor_vendor_listing.xml add url path as vendor/vendor/add near “add” field.
=>Create Add.php in Dhruvi\Vendor\Controller\Adminhtml\Vendor\App.php
=>Create vendor_vendor_add.xml i.e., route_controller_action.xml in Dhruvi\Vendor\view\adminhtml\layout\route_controller_action.xml
Example : Dhruvi\Vendor\view\adminhtml\layout\vendor_vendor_add.xml

    <?xml version="1.0" encoding="UTF-8"?>
    <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
        <update handle="styles" />

        <body>
            <referenceContainer name="content">
                <uiComponent name="vendor_vendor_newvendor" />
            </referenceContainer>
        </body>
    </page>
  
12.  Create `vendor_vendor_newvendor.xml` i.e., uiComponent name in “vendor_vendor_add.xml” in layout folder(`view\adminhtml\layout`).
    
Example : 		
	`Dhruvi\Vendor\view\adminhtml\layout\vendor_vendor_newvendor.xml`
=>In this, Form to add vendor is created.
13.  Run 
	
	Setup upgrade=>go to admin part of magento=>In submenu=>click Add a new Vendor.
    
=>Form is displayed.
