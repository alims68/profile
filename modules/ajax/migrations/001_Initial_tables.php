<?php
class Migration_Numbers_tables extends Migration
{

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field('number_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        
        $this->dbforge->add_field('number VARCHAR(255) NOT NULL');
        $this->dbforge->add_field('key VARCHAR(5) NOT NULL');
        $this->dbforge->add_field('count TINYINT(1) NOT NULL');
        $this->dbforge->add_field('status TINYINT(1) NOT NULL');
        $this->dbforge->add_field('created_on DATETIME NOT NULL');
        $this->dbforge->add_field('modified_on DATETIME NULL');
        $this->dbforge->add_field('deleted TINYINT(1) NOT NULL DEFAULT 0');
        $this->dbforge->add_key('number_id', TRUE);

        $this->dbforge->create_table('numbers');
        /*
        // Create the Permissions
        $this->load->model('permission_model');
        $this->permission_model->insert(array(
            'name'          => 'Site.User.View',
            'description'   => 'دسترسی به روت user',
            'status'        => 'active'
        ));

        // Assign them to the admin role
        $this->load->model('role_permission_model');
        $this->role_permission_model->assign_to_role('Administrator', 'Bonfire.Blog.View');
        */
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('numbers');
    }

    //--------------------------------------------------------------------

}