          <li <?php if ($main_breadcrumb == 'Form') {echo 'class="active"';} ?>>
            <a href="#">
              <i class="fa fa-pencil"></i> 
              <span class="nav-label">Form</span><span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li <?php if ($sub_breadcrumb == 'Basic Form') {echo 'class="active"';} ?> >
                <a href="<?php echo base_url();?>basic_form/">Basic Form</a>
              </li>
              <li <?php if ($sub_breadcrumb == 'Dynamic Form') {echo 'class="active"';} ?> >
                <a href="<?php echo base_url();?>dynamic_form/">Dynamic Form</a>
              </li>
            </ul>
          </li>
          <li <?php if ($main_breadcrumb == 'Table') {echo 'class="active"';} ?>>
            <a href="#">
              <i class="fa fa-table"></i> 
              <span class="nav-label">Table</span><span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li <?php if ($sub_breadcrumb == 'Basic Table') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>basic_table/">Basic Table</a>
              </li>

              <li <?php if ($sub_breadcrumb == 'Basic Table Custom Filter') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>basic_table_filter/">Basic Table Custom Filter</a>
              </li>
              <li <?php if ($sub_breadcrumb == 'Join Table') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>join_table/">Join Table</a>
              </li>
              <li <?php if ($sub_breadcrumb == 'Basic Table JSON') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>basic_table_json/">Basic Table JSON</a>
              </li>

              <li <?php if ($sub_breadcrumb == 'Basic Table JSON Custom Filter') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>basic_table_json_filter/">Basic Table JSON Custom Filter</a>
              </li>
            </ul>
          </li>
          <li <?php if ($main_breadcrumb == 'Calendar') {echo 'class="active"';} ?>>
            <a href="#">
              <i class="fa fa-calendar"></i> 
              <span class="nav-label">Calendar</span><span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li <?php if ($sub_breadcrumb == 'Calendar Events') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>calendar_events/">Calendar Event</a>
              </li>
              <li <?php if ($sub_breadcrumb == 'Calendar Events View') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>calendar_events_view/">Calendar Event View</a>
              </li>
            </ul>
          </li>
          <li <?php if ($main_breadcrumb == 'Gallery') {echo 'class="active"';} ?>>
            <a href="#">
              <i class="fa fa-image"></i> 
              <span class="nav-label">Gallery</span><span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li <?php if ($sub_breadcrumb == 'Create Gallery') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>gallery/create_gallery/">Create Gallery</a>
              </li>
              <li <?php if ($sub_breadcrumb == 'View Gallery') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>gallery/view_gallery/">View Gallery</a>
              </li>
            </ul>
          </li>
          <li <?php if ($main_breadcrumb == 'Slider') {echo 'class="active"';} ?>>
            <a href="#">
              <i class="fa fa-image"></i> 
              <span class="nav-label">Slider</span><span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li <?php if ($main_breadcrumb == 'Add Slide') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url();?>slider/">Add Slider</a>
              </li>
            </ul>
          </li>
          
          
          
          
