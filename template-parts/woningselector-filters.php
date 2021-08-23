<?php global $homes; ?>
<div class="row">
    <div class="col">
        <label for="buildingSelect" class="form-label"><?php esc_html_e('Building', 'strt'); ?></label>
        <select id="buildingSelect" class="filters-select form-select form-select-sm mb-2" value-group="building">
            <option value="*"><?php echo __('Show all', 'strt'); ?></option>
            <?php 
            foreach ( get_terms( array('taxonomy' => 'home_building') ) as $building ) :
                echo '<option value=".' . $building->slug . '">' . $building->name . ' (' . $building->count . ')</option>';
            endforeach;
            ?>
        </select>
    </div>
    <div class="col">
        <label for="typeSelect" class="form-label"><?php esc_html_e('Type', 'strt'); ?></label>
        <select id="typeSelect" class="filters-select form-select form-select-sm mb-2" value-group="type">
            <option value="*"><?php echo __('Show all', 'strt'); ?></option>
            <?php 
            foreach ( get_terms( array('taxonomy' => 'home_type') ) as $type ) :
                echo '<option value=".' . $type->slug . '">' . $type->name . ' (' . $type->count . ')</option>';
            endforeach;
            ?>
        </select>
    </div>
    <div class="col">
        <label for="categorySelect" class="form-label"><?php esc_html_e('Category', 'strt'); ?></label>
        <select id="categorySelect" class="filters-select form-select form-select-sm mb-2" value-group="category">
            <option value="*"><?php echo __('Show all', 'strt'); ?></option>
            <?php 
            $categoryArray = [];
            foreach ( $homes as $post ) :
                $category = get_post_meta( $post->ID, 'category', true );
                if ( ! in_array( $category, $categoryArray ) ) :
                    array_push( $categoryArray, $category );
                endif;
            endforeach;
            foreach ( $categoryArray as $categoryTerm ) : 
                echo '<option value=".' . str_replace(' ', '_', $categoryTerm) . '">' . $categoryTerm . '</option>';
            endforeach;
            ?>
        </select>
    </div>
    <div class="col">
        <label for="availabiltySelect" class="form-label"><?php esc_html_e('Availability', 'strt'); ?></label>
        <select id="availabiltySelect" class="filters-select form-select form-select-sm mb-2" value-group="availability">
            <option value="*"><?php echo __('Show all', 'strt'); ?></option>
            <?php 
            $availabilityArray = [];
            foreach ( $homes as $post ) :
                $availability = get_post_meta( $post->ID, 'availability', true );
                if ( ! in_array( $availability, $availabilityArray ) ) :
                    array_push( $availabilityArray, $availability );
                endif;
            endforeach;
            foreach ( $availabilityArray as $availabilityTerm ) : 
                echo '<option value=".' . str_replace(' ', '_', $availabilityTerm) . '">' . $availabilityTerm . '</option>';
            endforeach;
            ?>
        </select>
    </div>
    <div class="col">
        <label for="priceRange" class="form-label"><?php esc_html_e('Price range:', 'strt'); ?>
            <span class="price-range-output"></span>
        </label>
        <div id="priceRange" class="price-range"></div>
    </div>
</div>
