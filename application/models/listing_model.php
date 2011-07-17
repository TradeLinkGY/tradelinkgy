<?php

class Listing_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('functions');
    }

    function insert_listing($id_user, $id_subcategory, $listing_name, $listing_desc, $listing_keywords, $listing_price, $listing_userdesc, $listing_featured, $listing_status, $listing_created, $listing_expiry_period, $listing_inserted_by) {
        $data = array(
            'id_user' => $id_user, 'id_subcategory' => $id_subcategory, 'listing_name' => $listing_name,
            'listing_desc' => $listing_desc, 'listing_userdesc' => $listing_userdesc, 'listing_price' => $listing_price,
            'listing_keywords' => $listing_keywords, 'listing_created' => date("Y-m-d H:i:s"), '$listing_status' => $listing_status,
            'listing_featured' => $listing_featured, 'listing_expiry' => $this->functions->set_activity_period(date("Y-m-d H:i:s"), $listing_expiry_period), 'listing_inserted_by' => $listing_inserted_by);

        $this->db->insert('listings_tb', $data);
        return $this->db->insert_id();
    }

    function update_listing($id_listing, $id_subcategory, $listing_name, $listing_desc, $listing_keywords, $listing_userdesc, $listing_price) {
        $data = array(
            'id_subcategory' => $id_subcategory,
            'listing_name' => $listing_name,
            'listing_desc' => $listing_desc,
            'listing_keywords' => $listing_keywords,
            'listing_userdesc' => $listing_userdesc,
            'listing_price' => $listing_price);
        $this->db->where('id_listing', $id_listing);
        $this->db->update('listing_tb', $data);
    }

    // full listing means that it would contain the contents of 
    // the listing table pluspo other related tables eg. user, images etc.
    function get_full_listing($listing) {

        // Determine if listing is allocated to a store
        $this->db->where('id_user', $listing->id_user);
        $query = $this->db->get('store_profile_tb');
        $hasStore = $query->num_rows > 0 ? true : false;

        // Determine if there is an image
        $this->db->where('id_listing', $listing->id_listing);
        $query = $this->db->get('listing_image_tb');
        $hasImages = $query->num_rows > 0 ? TRUE : FALSE;

        // Determine relations and return listing
        $this->db
                ->where('id_listing', $listing->id_listing)
                ->from('listing_tb');
        $this->db->join('user_tb', 'user_tb.id_user=listing_tb.id_user');

        if ($hasImages)
            $this->db->join('listing_image_tb', 'listing_image_tb.id_listing = listing_tb.id_listing', 'left');
        if ($hasStore)
            $this->db->join('store_profile_tb', 'listing_tb.id_user=store_profile_tb.id_user');

        $this->db->join('subcategory_tb', 'listing_tb.id_subcategory=subcategory_tb.id_subcategory');
        $this->db->join('category_tb', 'subcategory_tb.id_category=category_tb.id_category');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return FALSE;
    }

    function get_featured_listings($listing_type) {
        $this->db->where('listing_type', $listing_type);
        $this->db->where('listing_featured', 1);
        $query = $this->db->get('listing_tb');

        $result = array();

        foreach ($query->result() as $row) {
            $listing = $this->get_full_listing($row);
            if ($listing)
                array_push($result, $listing);
        }

        return $result;
    }

    function get_recent_listings($type_listing, $num_results, $offset=0, $count_listings=false) {
        $this->db->where('listing_type', $type_listing);
        $this->db->order_by('listing_created', 'DESC');
        $this->db->limit($num_results, $offset);
        $query = $this->db->get('listing_tb');

        if (!$count_listings) {
            $result = array();

            foreach ($query->result() as $row) {
                $listing = $this->get_full_listing($row);
                if ($listing)
                    array_push($result, $listing);
            }

            return $result;
        }
        return $query->num_rows();


        $this->db->where('listing_type', $type_listing);
        $this->db->from('listing_tb');
        $this->db->join('listing_image_tb', 'listing_tb.id_listing = listing_image_tb.id_listing', 'left');
        $this->db->join('subcategory_tb', 'listing_tb.id_subcategory=subcategory_tb.id_subcategory');
        $this->db->join('category_tb', 'subcategory_tb.id_category=category_tb.id_category');
        $this->db->join('user_tb', 'user_tb.id_user=listing_tb.id_user');
        //$this->db->group_by('item_image_tb.id_item');
        if (!$count_listings) {
            $this->db->limit($num_results, $offset);
            $query = $this->db->get();
            return $query->result();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_listing_by_id($id_listing) {

        $this->db->where('id_listing', $id_listing);
        $listing = $this->db->get('listing_tb');
        return $this->get_full_listing($listing->row());
    }

    function get_listings_by_user($id_user, $limit, $offset) {
        $this->db
                ->where('id_user', $id_user)
                ->limit($limit, $offset);
        $query = $this->db->get('listing_tb');

        //Results
        $tmp = array();
        foreach ($query->result() as $row) {
            $listing = $this->get_full_listing($row);
            if ($listing)
                array_push($tmp, $listing);
        }
        $result['rows'] = $tmp;
        
        //Count Rows
        $this->db->where('id_user', $id_user)
                ->from('listing_tb');
        $result['num_rows'] = $this->db->count_all_results();

        return $result;
    }

    function get_listings_by_subcategory($id_subcategory) {
        $this->db->where('id_subcategory', $id_subcategory);
        $query = $this->db->get('listing_tb');

        $result = array();

        foreach ($query->result() as $row) {
            $listing = $this->get_full_listing($row);
            if ($listing)
                array_push($listing, $result);
        }

        return $result;
    }

    function get_listings_by_category($id_category) {
        $this->db->where('id_category', $id_category);
        $query = $this->db->get('subcategory_tb');

        $result = array();

        foreach ($query->result() as $row) {
            $temp = $this->get_listings_by_subcategory($row->id_subcategory);
            $result = array_push($temp, $result);
        }

        return $result();
    }

    function get_listings_by_type($type) {
        $this->db->select('listing_tb.id_listing, id_user');
        $this->db->where('listing_type', $type);
        $this->db->join('listing_image_tb', 'listing_image_tb.id_listing=listing_tb.id_listing', 'left');
        $query = $this->db->get('listing_tb');

        $result = array();

        foreach ($query->result() as $row) {
            $listing = $this->get_full_listing($row);
            if ($listing)
                array_push($result, $listing);
        }

        return $result;
    }

    function get_listings_by_status($status) {
        $this->db->where('listing_status', $status);
        $query = $this->db->get('listing_tb');

        $result = array();

        foreach ($query->result() as $row) {
            $listing = $this->get_full_listing($row);
            if ($listing)
                array_push($listing, $result);
        }

        return $result;
    }

    function get_listings_by_company($company) {
        
    }

    function get_status($listing) {
        $this->db->where('id_listing', $listing->id_listing);
        $query = $this->db->get('listing_tb');
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $result)
                return $result['listing_status'];
        }
        return FALSE;
    }

    function toggle_status($listing) {
        
    }

    private function query_db($search_str, $search_cat, $limit=false, $offset=false, $sort_by=false, $sort_order=false) {

        if ($search_cat != 'all')
            $where = "listing_tb.listing_status = 'active' AND subcategory_tb.id_category = $search_cat AND (listing_tb.listing_name like '%$search_str%' OR listing_tb.listing_keyword like '%$search_str%' OR listing_tb.listing_desc like '%$search_str%' OR category_tb.desc_category like '%$search_str%')";
        else
            $where = "listing_tb.listing_status = 'active' AND listing_tb.listing_name like '%$search_str%' OR listing_tb.listing_status = 'active' AND listing_tb.listing_keyword like '%$search_str%' OR listing_tb.listing_status = 'active' AND listing_tb.listing_desc like '%$search_str%' OR listing_tb.listing_status = 'active' AND category_tb.desc_category like '%$search_str%'";

        $sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
        //$sort_columns = array('listing_fullname', 'listing_userdesc');
        //$sory_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id_listing';

        $select_fields = array(
            'listing_tb.id_listing',
            'listing_name',
            'user_fullname',
            'listing_tb.id_user',
            'listing_desc',
            'listing_price',
            'listing_keyword',
            'listing_userdesc',
            'listing_created',
            'listing_expiry',
            'listing_featured',
            'desc_category'
        );

        $this->db
                ->select($select_fields)
                ->from('listing_tb')
                ->where($where);


        $this->db->join('subcategory_tb', 'subcategory_tb.id_subcategory = listing_tb.id_subcategory');
        $this->db->join('category_tb', 'category_tb.id_category = subcategory_tb.id_category');
        $this->db->join('user_tb', 'user_tb.id_user=listing_tb.id_user');
        $this->db->join('listing_image_tb', 'listing_tb.id_listing = listing_image_tb.id_listing', 'left');
        if ($limit)
            $this->db->limit($limit, $offset);
        if ($sort_by)
            $this->db->order_by($sort_by, $sort_order);

        $query = $this->db->get();

        $result['rows'] = $query->result();
        $result['num_rows'] = $query->num_rows();

        return $result;
    }

    function search($search_str, $search_cat, $limit=false, $offset=false, $sort_by=false, $sort_order=false) {
        $search_str = str_replace(" ", "%", $search_str);
        $result = $this->query_db($search_str, $search_cat, $limit, $offset, $sort_by, $sort_order);

        // If search string not found, split string into words and search individually
        if (count($result) == 0) {
            $search_str = str_replace('%', ' ', $search_str);
            $search_str = explode(' ', $search_str);
            if (count($search_str) > 1) {
                foreach ($search_str as $str) {
                    //find search results for each word and merge into a single array $result
                    $temp = $this->query_db($limit, $offset, $sort_by, $sort_order, $str, $search_cat);
                    $result = array_merge($result, $temp['rows']);
                }

                // remove duplicate entries within array (if any)
                $values = array();
                foreach ($result as $data)
                    $values[md5(serialize($data))] = $data;
                $result = $values;
            }
        }

        return $result;
    }

}