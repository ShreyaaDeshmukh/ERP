--
-- Table structure for table `web_setting`
--

CREATE TABLE `web_setting` (
  `setting_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `invoice_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `currency_position` varchar(10) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `rtr` varchar(255) DEFAULT NULL,
  `captcha` int(11) DEFAULT '1' COMMENT '0=active,1=inactive',
  `site_key` varchar(250) DEFAULT NULL,
  `secret_key` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `web_setting` (`setting_id`, `logo`, `invoice_logo`, `favicon`, `currency`, `currency_position`, `footer_text`, `language`, `rtr`, `captcha`, `site_key`, `secret_key`) VALUES
(1, 'http://wholesalenew.bdtask.com/newholesale/my-assets/image/logo/c68f23341f5dfaf735900d8830dec368.png', 'http://wholesalenew.bdtask.com/newholesale/my-assets/image/logo/f9d367431dc8fd3d0e0f555f4ebdbe70.png', 'http://wholesalenew.bdtask.com/newholesale/my-assets/image/logo/911ab09abfe5899b768dae55ea129049.png', '$', '0', 'Copyright by bdtask limited', 'english', '0', 1, '6LdiKhsUAAAAAMV4jQRmNYdZy2kXEuFe1HrdP5tt', '6LdiKhsUAAAAABH4BQCIvBar7Oqe-2LwDKxMSX-t');

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` varchar(220) NOT NULL,
  `account_table_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `account_2`
--

CREATE TABLE `account_2` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `bank_add`
--

CREATE TABLE `bank_add` (
  `bank_id` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ac_name` varchar(250) DEFAULT NULL,
  `ac_number` varchar(250) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `signature_pic` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Table structure for table `bank_summary`
--

CREATE TABLE `bank_summary` (
  `bank_id` varchar(250) DEFAULT NULL,
  `description` text,
  `deposite_id` varchar(250) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `ac_type` varchar(50) DEFAULT NULL,
  `dr` float DEFAULT NULL,
  `cr` float DEFAULT NULL,
  `ammount` float DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





--
-- Table structure for table `cheque_manger`
--

CREATE TABLE `cheque_manger` (
  `cheque_id` varchar(100) NOT NULL,
  `transection_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `bank_id` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `date` varchar(250) DEFAULT NULL,
  `transection_type` varchar(100) NOT NULL,
  `cheque_status` int(10) NOT NULL,
  `amount` float NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `company_id` varchar(250) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`company_id`, `company_name`, `email`, `address`, `mobile`, `website`, `status`) VALUES
('1', 'BDTaskS', 'bdtask@gmatil.com', 'Khilkhet, Dhaka', '01258996325', 'http://bdtask.com/', 1);

--
-- Table structure for table `customer_information`
--

CREATE TABLE `customer_information` (
  `customer_id` varchar(250) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_mobile` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `status` int(2) NOT NULL COMMENT '1=paid,2=credit'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`customer_id`, `customer_name`, `customer_address`, `customer_mobile`, `customer_email`, `status`) VALUES
('L2Q546BXXJ894VY', 'William', '', '354678641', 'william@gmail.com', 1),
('VKOJYW6J9KEE5V2', 'Isla', '', '14787145454', 'isla@gmail.com', 1),
('SKI9P4ZGEZ6YRK7', 'jonh Smith', '', '53468784', 'jonhsmith@gmail.com', 1),
('7K9KDEPKD1SLNI3', 'Taylor', '', '546878641231', 'taylor@gmail.com', 1),
('24P51HOXDQ57OI8', 'Evans', 'India', '684854311', 'evans@gmail.com', 1),
('TYFGJDZ5B8DTTUJ', 'Thomas', 'India', '245476461', 'thomas@gmail.com', 1),
('CQ6GEO12JT8WNQC', 'Roberts', 'New York', '1445454', 'roberts@gail.com', 1),
('TPW4DFJMTN2PFNI', 'Davies', 'America', '455744444', 'davies@gmail.com', 1),
('AHH1KVMMCG5PGOY', 'Lily', 'Bangladesh', '45765765', 'lily@gmail.com', 2),
('RQFLP5ASKAU37TZ', 'Ava', 'Japan', '457657', 'ava@gmail.com', 2);

--
-- Table structure for table `customer_ledger`
--

CREATE TABLE `customer_ledger` (
  `transaction_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `date` varchar(250) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `d_c` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_ledger`
--

INSERT INTO `customer_ledger` (`transaction_id`, `customer_id`, `invoice_no`, `receipt_no`, `amount`, `description`, `payment_type`, `cheque_no`, `date`, `status`, `d_c`) VALUES
('G4Q8LW1L5O', 'L2Q546BXXJ894VY', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('KATONECXQT', 'VKOJYW6J9KEE5V2', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('8MQYE41HMS', 'SKI9P4ZGEZ6YRK7', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('IWC1H2NP1L', '7K9KDEPKD1SLNI3', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('ZBOY97APMJ', '24P51HOXDQ57OI8', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('X3NN2349DB', 'TYFGJDZ5B8DTTUJ', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('FJ23FQN9FQ', 'CQ6GEO12JT8WNQC', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('ZBD45REEOD', 'TPW4DFJMTN2PFNI', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('UVIM3WS6MQ', 'AHH1KVMMCG5PGOY', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('NLE4YZJ6W1', 'RQFLP5ASKAU37TZ', 'NA', NULL, 0, 'Previous adjustment with software', 'NA', 'NA', '02-10-2018', 1, 'd'),
('BUE6ZXI5M9SNNWG', 'L2Q546BXXJ894VY', NULL, '6YN1PR39TZ', 73200, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('BUE6ZXI5M9SNNWG', 'L2Q546BXXJ894VY', '5931563128', NULL, 73200, '', '', '', '2018-10-02', 1, 'd'),
('I11Z8S3VN2EN9AD', 'VKOJYW6J9KEE5V2', NULL, '394V9S41KU', 30000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('I11Z8S3VN2EN9AD', 'VKOJYW6J9KEE5V2', '7531261799', NULL, 34376, '', '', '', '2018-10-02', 1, 'd'),
('V6UTMG9J6NLXT3Z', '7K9KDEPKD1SLNI3', NULL, 'V6GPTOBR9X', 25000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('V6UTMG9J6NLXT3Z', '7K9KDEPKD1SLNI3', '5195586496', NULL, 29760, '', '', '', '2018-10-02', 1, 'd'),
('LKUWRTOWS6U6MPC', '24P51HOXDQ57OI8', NULL, 'NK9Y8IBI2X', 14000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('LKUWRTOWS6U6MPC', '24P51HOXDQ57OI8', '1629519169', NULL, 14400, '', '', '', '2018-10-02', 1, 'd'),
('LNXTMGB6HVNMGRQ', 'TYFGJDZ5B8DTTUJ', NULL, '6WFWJP8WEV', 50000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('LNXTMGB6HVNMGRQ', 'TYFGJDZ5B8DTTUJ', '1239664497', NULL, 527880, '', '', '', '2018-10-02', 1, 'd'),
('NFTJMJN6STAMZLX', 'TPW4DFJMTN2PFNI', NULL, '6T2VKD8PZH', 16000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('NFTJMJN6STAMZLX', 'TPW4DFJMTN2PFNI', '6716737717', NULL, 16500, '', '', '', '2018-10-02', 1, 'd'),
('2CQM973QST9F539', 'CQ6GEO12JT8WNQC', NULL, '2Q6M5AG7RU', 30000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('2CQM973QST9F539', 'CQ6GEO12JT8WNQC', '4625643945', NULL, 31200, '', '', '', '2018-10-02', 1, 'd'),
('CYGVVUL6LWX2HII', 'SKI9P4ZGEZ6YRK7', NULL, 'DYW2ZE5OLP', 17000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('CYGVVUL6LWX2HII', 'SKI9P4ZGEZ6YRK7', '2251588339', NULL, 17000, '', '', '', '2018-10-02', 1, 'd'),
('FZGBWVVSMHSEOQM', 'VKOJYW6J9KEE5V2', NULL, '7GBXS54JC5', 20000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('FZGBWVVSMHSEOQM', 'VKOJYW6J9KEE5V2', '1713876791', NULL, 25080, '', '', '', '2018-10-02', 1, 'd'),
('EUK6FHHQAXMPGF9', 'TYFGJDZ5B8DTTUJ', NULL, 'X9POMOS7ZP', 25000, 'Cash Paid By Customer', '1', '', '2018-10-02', 1, 'c'),
('EUK6FHHQAXMPGF9', 'TYFGJDZ5B8DTTUJ', '7645516555', NULL, 33000, '', '', '', '2018-10-02', 1, 'd'),
('IWD7UEDJQAMHAUW', 'VKOJYW6J9KEE5V2', NULL, '2IJCCFFC5C', 1000, '', '1', '', '2018-10-02', 1, 'c');



--
-- Table structure for table `daily_banking_add`
--

CREATE TABLE `daily_banking_add` (
  `banking_id` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `bank_id` varchar(100) NOT NULL,
  `deposit_type` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `daily_closing`
--

CREATE TABLE `daily_closing` (
  `closing_id` varchar(255) NOT NULL,
  `last_day_closing` float NOT NULL,
  `cash_in` float NOT NULL,
  `cash_out` float NOT NULL,
  `date` varchar(250) NOT NULL,
  `amount` float NOT NULL,
  `adjustment` float DEFAULT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `head_office_deposit`
--

CREATE TABLE `head_office_deposit` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `inflow_92mizdldrv`
--

CREATE TABLE `inflow_92mizdldrv` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `inflow_92mizdldrv`
--

INSERT INTO `inflow_92mizdldrv` (`transection_id`, `tracing_id`, `payment_type`, `date`, `amount`, `description`, `status`) VALUES
('2CQM973QST9F539', 'CQ6GEO12JT8WNQC', '1', '2018-10-02 00:00:00', 30000, 'ITP', 1),
('BUE6ZXI5M9SNNWG', 'L2Q546BXXJ894VY', '1', '2018-10-02 00:00:00', 73200, 'ITP', 1),
('CYGVVUL6LWX2HII', 'SKI9P4ZGEZ6YRK7', '1', '2018-10-02 00:00:00', 17000, 'ITP', 1),
('EUK6FHHQAXMPGF9', 'TYFGJDZ5B8DTTUJ', '1', '2018-10-02 00:00:00', 25000, 'ITP', 1),
('FZGBWVVSMHSEOQM', 'VKOJYW6J9KEE5V2', '1', '2018-10-02 00:00:00', 20000, 'ITP', 1),
('I11Z8S3VN2EN9AD', 'VKOJYW6J9KEE5V2', '1', '2018-10-02 00:00:00', 30000, 'ITP', 1),
('IWD7UEDJQAMHAUW', 'VKOJYW6J9KEE5V2', '1', '2018-10-02 00:00:00', 1000, 'ITP', 1),
('LKUWRTOWS6U6MPC', '24P51HOXDQ57OI8', '1', '2018-10-02 00:00:00', 14000, 'ITP', 1),
('LNXTMGB6HVNMGRQ', 'TYFGJDZ5B8DTTUJ', '1', '2018-10-02 00:00:00', 50000, 'ITP', 1),
('NFTJMJN6STAMZLX', 'TPW4DFJMTN2PFNI', '1', '2018-10-02 00:00:00', 16000, 'ITP', 1),
('V6UTMG9J6NLXT3Z', '7K9KDEPKD1SLNI3', '1', '2018-10-02 00:00:00', 25000, 'ITP', 1);



--
-- Table structure for table `inflow_yh5i8w9oea`
--

CREATE TABLE `inflow_yh5i8w9oea` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `total_discount` float DEFAULT NULL COMMENT 'total invoice discount',
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_id`, `date`, `total_amount`, `invoice`, `total_discount`, `status`) VALUES
('5931563128', 'L2Q546BXXJ894VY', '2018-10-02', 73200, '1000', 850, 1),
('7531261799', 'VKOJYW6J9KEE5V2', '2018-10-02', 34376, '1001', 0, 1),
('5195586496', '7K9KDEPKD1SLNI3', '2018-10-02', 29760, '1002', 240, 1),
('1629519169', '24P51HOXDQ57OI8', '2018-10-02', 14400, '1003', 600, 1),
('1239664497', 'TYFGJDZ5B8DTTUJ', '2018-10-02', 527880, '1004', 120, 1),
('6716737717', 'TPW4DFJMTN2PFNI', '2018-10-02', 16500, '1005', 0, 1),
('4625643945', 'CQ6GEO12JT8WNQC', '2018-10-02', 31200, '1006', 0, 1),
('2251588339', 'SKI9P4ZGEZ6YRK7', '2018-10-02', 17000, '1007', 0, 1),
('1713876791', 'VKOJYW6J9KEE5V2', '2018-10-02', 25080, '1008', 320, 1),
('7645516555', 'TYFGJDZ5B8DTTUJ', '2018-10-02', 33000, '1009', 1000, 1);

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_details_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `cartoon` float DEFAULT NULL,
  `quantity` float NOT NULL,
  `rate` float NOT NULL,
  `supplier_rate` float DEFAULT NULL,
  `total_price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `paid_amount` float DEFAULT '0',
  `due_amount` float NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_details_id`, `invoice_id`, `product_id`, `cartoon`, `quantity`, `rate`, `supplier_rate`, `total_price`, `discount`, `tax`, `paid_amount`, `due_amount`, `status`) VALUES
('739679213738758', '5931563128', '86875793', 2, 40, 850, 720, 34000, 10, NULL, 73200, 0, 1),
('221349213958754', '5931563128', '74261881', 3, 45, 890, 750, 40050, 10, NULL, 73200, 0, 1),
('784322452468998', '7531261799', '26647817', 2, 24, 999, 810, 23976, 0, NULL, 30000, 4376, 1),
('158858656252125', '7531261799', '48118641', 1, 20, 520, 410, 10400, 0, NULL, 30000, 4376, 1),
('826211576352456', '5195586496', '86119874', 2, 24, 1250, 1100, 30000, 10, NULL, 25000, 4760, 1),
('741499984494914', '1629519169', '72118779', 3, 60, 250, 140, 15000, 10, NULL, 14000, 400, 1),
('136952384845964', '1239664497', '63245498', 2, 24, 22000, 20000, 528000, 5, NULL, 50000, 477880, 1),
('896752789156862', '6716737717', '23752845', 2, 30, 550, 490, 16500, 0, NULL, 16000, 500, 1),
('944499418213737', '4625643945', '48118641', 3, 60, 520, 410, 31200, 0, NULL, 30000, 1200, 1),
('187924696827178', '2251588339', '86875793', 1, 20, 850, 720, 17000, 0, NULL, 17000, 0, 1),
('965416921452164', '1713876791', '86119874', 1, 12, 1250, 1100, 15000, 10, NULL, 20000, 5080, 1),
('931632642391231', '1713876791', '48118641', 1, 20, 520, 410, 10400, 10, NULL, 20000, 5080, 1),
('196593945143787', '7645516555', '86875793', 2, 40, 850, 720, 34000, 25, NULL, 25000, 8000, 1);

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) UNSIGNED NOT NULL,
  `phrase` text NOT NULL,
  `english` text,
  `bangla` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`) VALUES
(1, 'user_profile', 'User Profile', ''),
(2, 'setting', 'Setting', ''),
(3, 'language', 'Language', ''),
(4, 'manage_users', 'Manage Users', ''),
(5, 'add_user', 'Add User', ''),
(6, 'manage_company', 'Manage Company', ''),
(7, 'web_settings', 'Software Settings', ''),
(8, 'manage_accounts', 'Manage Accounts', ''),
(9, 'create_accounts', 'Create Account', ''),
(10, 'manage_bank', 'Manage Bank', ''),
(11, 'add_new_bank', 'Add New Bank', ''),
(12, 'settings', 'Bank', ''),
(13, 'closing_report', 'Closing Report', ''),
(14, 'closing', 'Closing', ''),
(15, 'cheque_manager', 'Cheque Manager', ''),
(16, 'accounts_summary', 'Accounts Summary', ''),
(17, 'expense', 'Expense', ''),
(18, 'income', 'Income', ''),
(19, 'accounts', 'Accounts', ''),
(20, 'stock_report', 'Stock Report', ''),
(21, 'stock', 'Stock', ''),
(22, 'pos_invoice', 'POS Invoice', ''),
(23, 'manage_invoice', 'Manage Invoice ', ''),
(24, 'new_invoice', 'New Invoice', ''),
(25, 'invoice', 'Invoice', ''),
(26, 'manage_purchase', 'Manage Purchase', ''),
(27, 'add_purchase', 'Add Purchase', ''),
(28, 'purchase', 'Purchase', ''),
(29, 'paid_customer', 'Paid Customer', ''),
(30, 'manage_customer', 'Manage Customer', ''),
(31, 'add_customer', 'Add Customer', ''),
(32, 'customer', 'Customer', ''),
(33, 'supplier_payment_actual', 'Supplier Payment Ledger', ''),
(34, 'supplier_sales_summary', 'Supplier Sales Summary', ''),
(35, 'supplier_sales_details', 'Supplier Sales Details', ''),
(36, 'supplier_ledger', 'Supplier Ledger', ''),
(37, 'manage_supplier', 'Manage Supplier', ''),
(38, 'add_supplier', 'Add Supplier', ''),
(39, 'supplier', 'Supplier', ''),
(40, 'product_statement', 'Product Statement', ''),
(41, 'manage_product', 'Manage Product', ''),
(42, 'add_product', 'Add Product', ''),
(43, 'product', 'Product', ''),
(44, 'manage_category', 'Manage Category', ''),
(45, 'add_category', 'Add Category', ''),
(46, 'category', 'Category', ''),
(47, 'sales_report_product_wise', 'Sales Report (Product Wise)', ''),
(48, 'purchase_report', 'Purchase Report', ''),
(49, 'sales_report', 'Sales Report', ''),
(50, 'todays_report', 'Todays Report', ''),
(51, 'report', 'Report', ''),
(52, 'dashboard', 'Dashboard', ''),
(53, 'online', 'Online', ''),
(54, 'logout', 'Logout', ''),
(55, 'change_password', 'Change Password', ''),
(56, 'total_purchase', 'Total Purchase', ''),
(57, 'total_amount', 'Total Amount', ''),
(58, 'supplier_name', 'Supplier Name', ''),
(59, 'invoice_no', 'Invoice No', ''),
(60, 'purchase_date', 'Purchase Date', ''),
(61, 'todays_purchase_report', 'Todays Purchase Report', ''),
(62, 'total_sales', 'Total Sales', ''),
(63, 'customer_name', 'Customer Name', ''),
(64, 'sales_date', 'Sales Date', ''),
(65, 'todays_sales_report', 'Todays Sales Report', ''),
(66, 'home', 'Home', ''),
(67, 'todays_sales_and_purchase_report', 'Todays sales and purchase report', ''),
(68, 'total_ammount', 'Total Amount', ''),
(69, 'rate', 'Rate', ''),
(70, 'product_model', 'Product Model', ''),
(71, 'product_name', 'Product Name', ''),
(72, 'search', 'Search', ''),
(73, 'end_date', 'End Date', ''),
(74, 'start_date', 'Start Date', ''),
(75, 'total_purchase_report', 'Total Purchase Report', ''),
(76, 'total_sales_report', 'Total Sales Report', ''),
(77, 'total_seles', 'Total Sales', ''),
(78, 'all_stock_report', 'All Stock Report', ''),
(79, 'search_by_product', 'Search By Product', ''),
(80, 'date', 'Date', ''),
(81, 'print', 'Print', ''),
(82, 'stock_date', 'Stock Date', ''),
(83, 'print_date', 'Print Date', ''),
(84, 'sales', 'Sales', ''),
(85, 'price', 'Price', ''),
(86, 'sl', 'SL.', ''),
(87, 'add_new_category', 'Add new category', ''),
(88, 'category_name', 'Category Name', ''),
(89, 'save', 'Save', ''),
(90, 'delete', 'Delete', ''),
(91, 'update', 'Update', ''),
(92, 'action', 'Action', ''),
(93, 'manage_your_category', 'Manage your category ', ''),
(94, 'category_edit', 'Category Edit', ''),
(95, 'status', 'Status', ''),
(96, 'active', 'Active', ''),
(97, 'inactive', 'Inactive', ''),
(98, 'save_changes', 'Save Changes', ''),
(99, 'save_and_add_another', 'Save And Add Another', ''),
(100, 'model', 'Model', ''),
(101, 'supplier_price', 'Supplier Price', ''),
(102, 'sell_price', 'Sell Price', ''),
(103, 'image', 'Image', ''),
(104, 'select_one', 'Select One', ''),
(105, 'details', 'Details', ''),
(106, 'new_product', 'New Product', ''),
(107, 'add_new_product', 'Add new product', ''),
(108, 'barcode', 'Barcode', ''),
(109, 'qr_code', 'Qr-Code', ''),
(110, 'product_details', 'Product Details', ''),
(111, 'manage_your_product', 'Manage your product', ''),
(112, 'product_edit', 'Product Edit', ''),
(113, 'edit_your_product', 'Edit your product', ''),
(114, 'cancel', 'Cancel', ''),
(115, 'incl_vat', 'Incl. Vat', ''),
(116, 'money', 'TK', ''),
(117, 'grand_total', 'Grand Total', ''),
(118, 'quantity', 'Quantity', ''),
(119, 'product_report', 'Product Report', ''),
(120, 'product_sales_and_purchase_report', 'Product sales and purchase report', ''),
(121, 'previous_stock', 'Previous Stock', ''),
(122, 'out', 'Out', ''),
(123, 'in', 'In', ''),
(124, 'to', 'To', ''),
(125, 'previous_balance', 'Previous Balance', ''),
(126, 'customer_address', 'Customer Address', ''),
(127, 'customer_mobile', 'Customer Mobile', ''),
(128, 'customer_email', 'Customer Email', ''),
(129, 'add_new_customer', 'Add new customer', ''),
(130, 'balance', 'Balance', ''),
(131, 'mobile', 'Mobile', ''),
(132, 'address', 'Address', ''),
(133, 'manage_your_customer', 'Manage your customer', ''),
(134, 'customer_edit', 'Customer Edit', ''),
(135, 'paid_customer_list', 'Paid Customer List', ''),
(136, 'ammount', 'Amount', ''),
(137, 'customer_ledger', 'Customer Ledger', ''),
(138, 'manage_customer_ledger', 'Manage Customer Ledger', ''),
(139, 'customer_information', 'Customer Information', ''),
(140, 'debit_ammount', 'Debit Amount', ''),
(141, 'credit_ammount', 'Credit Amount', ''),
(142, 'balance_ammount', 'Balance Amount', ''),
(143, 'receipt_no', 'Receipt NO', ''),
(144, 'description', 'Description', ''),
(145, 'debit', 'Debit', ''),
(146, 'credit', 'Credit', ''),
(147, 'item_information', 'Item Information', ''),
(148, 'total', 'Total', ''),
(149, 'please_select_supplier', 'Please Select Supplier', ''),
(150, 'submit', 'Submit', ''),
(151, 'submit_and_add_another', 'Submit And Add Another One', ''),
(152, 'add_new_item', 'Add New Item', ''),
(153, 'manage_your_purchase', 'Manage your purchase', ''),
(154, 'purchase_edit', 'Purchase Edit', ''),
(155, 'purchase_ledger', 'Purchase Ledger', ''),
(156, 'invoice_information', 'Invoice Information', ''),
(157, 'paid_ammount', 'Paid Amount', ''),
(158, 'discount', 'Discount/Pcs.', ''),
(159, 'save_and_paid', 'Save And Paid', ''),
(160, 'payee_name', 'Payee Name', ''),
(161, 'manage_your_invoice', 'Manage your invoice', ''),
(162, 'invoice_edit', 'Invoice Edit', ''),
(163, 'new_pos_invoice', 'New POS invoice', ''),
(164, 'add_new_pos_invoice', 'Add new pos invoice', ''),
(165, 'product_id', 'Product ID', ''),
(166, 'paid_amount', 'Paid Amount', ''),
(167, 'authorised_by', 'Authorised By', ''),
(168, 'checked_by', 'Checked By', ''),
(169, 'received_by', 'Received By', ''),
(170, 'prepared_by', 'Prepared By', ''),
(171, 'memo_no', 'Memo No', ''),
(172, 'website', 'Website', ''),
(173, 'email', 'Email', ''),
(174, 'invoice_details', 'Invoice Details', ''),
(175, 'reset', 'Reset', ''),
(176, 'payment_account', 'Payment Account', ''),
(177, 'bank_name', 'Bank Name', ''),
(178, 'cheque_or_pay_order_no', 'Cheque/Pay Order No', ''),
(179, 'payment_type', 'Payment Type', ''),
(180, 'payment_from', 'Payment From', ''),
(181, 'payment_date', 'Payment Date', ''),
(182, 'add_income', 'Add Income', ''),
(183, 'cash', 'Cash', ''),
(184, 'cheque', 'Cheque', ''),
(185, 'pay_order', 'Pay Order', ''),
(186, 'payment_to', 'Payment To', ''),
(187, 'total_outflow_ammount', 'Total Expense Amount', ''),
(188, 'transections', 'Transections', ''),
(189, 'accounts_name', 'Accounts Name', ''),
(190, 'outflow_report', 'Expense Report', ''),
(191, 'inflow_report', 'Income Report', ''),
(192, 'all', 'All', ''),
(193, 'account', 'Account', ''),
(194, 'from', 'From', ''),
(195, 'account_summary_report', 'Account Summary Report', ''),
(196, 'search_by_date', 'Search By Date', ''),
(197, 'cheque_no', 'Cheque No', ''),
(198, 'name', 'Name', ''),
(199, 'closing_account', 'Closing Account', ''),
(200, 'close_your_account', 'Close your account', ''),
(201, 'last_day_closing', 'Last Day Closing', ''),
(202, 'cash_in', 'Cash In', ''),
(203, 'cash_out', 'Cash Out', ''),
(204, 'cash_in_hand', 'Cash In Hand', ''),
(205, 'add_new_bank', 'Add New Bank', ''),
(206, 'day_closing', 'Day Closing', ''),
(207, 'account_closing_report', 'Account Closing Report', ''),
(208, 'last_day_ammount', 'Last Day Amount', ''),
(209, 'adjustment', 'Adjustment', ''),
(210, 'pay_type', 'Pay Type', ''),
(211, 'customer_or_supplier', 'Customer,Supplier Or Others', ''),
(212, 'transection_id', 'Transections ID', ''),
(213, 'accounts_summary_report', 'Accounts Summary Report', ''),
(214, 'bank_list', 'Bank List', ''),
(215, 'bank_edit', 'Bank Edit', ''),
(216, 'debit_plus', 'Debit (+)', ''),
(217, 'credit_minus', 'Credit (-)', ''),
(218, 'account_name', 'Account Name', ''),
(219, 'account_type', 'Account Type', ''),
(220, 'account_real_name', 'Account Real Name', ''),
(221, 'manage_account', 'Manage Account', ''),
(222, 'company_name', 'Niha International', ''),
(223, 'edit_your_company_information', 'Edit your company information', ''),
(224, 'company_edit', 'Company Edit', ''),
(225, 'admin', 'Admin', ''),
(226, 'user', 'User', ''),
(227, 'password', 'Password', ''),
(228, 'last_name', 'Last Name', ''),
(229, 'first_name', 'First Name', ''),
(230, 'add_new_user_information', 'Add new user information', ''),
(231, 'user_type', 'User Type', ''),
(232, 'user_edit', 'User Edit', ''),
(233, 'rtr', 'RTR', ''),
(234, 'ltr', 'LTR', ''),
(235, 'ltr_or_rtr', 'LTR/RTR', ''),
(236, 'footer_text', 'Footer Text', ''),
(237, 'favicon', 'Favicon', ''),
(238, 'logo', 'Logo', ''),
(239, 'update_setting', 'Update Setting', ''),
(240, 'update_your_web_setting', 'Update your web setting', ''),
(241, 'login', 'Login', ''),
(242, 'your_strong_password', 'Your strong password', ''),
(243, 'your_unique_email', 'Your unique email', ''),
(244, 'please_enter_your_login_information', 'Please enter your login information.', ''),
(245, 'update_profile', 'Update Profile', ''),
(246, 'your_profile', 'Your Profile', ''),
(247, 're_type_password', 'Re-Type Password', ''),
(248, 'new_password', 'New Password', ''),
(249, 'old_password', 'Old Password', ''),
(250, 'new_information', 'New Information', ''),
(251, 'old_information', 'Old Information', ''),
(252, 'change_your_information', 'Change your information', ''),
(253, 'change_your_profile', 'Change your profile', ''),
(254, 'profile', 'Profile', ''),
(255, 'wrong_username_or_password', 'Wrong User Name Or Password !', ''),
(256, 'successfully_updated', 'Successfully Updated.', ''),
(257, 'blank_field_does_not_accept', 'Blank Field Does Not Accept !', ''),
(258, 'successfully_changed_password', 'Successfully changed password.', ''),
(259, 'you_are_not_authorised_person', 'You are not authorised person !', ''),
(260, 'password_and_repassword_does_not_match', 'Passwor and re-password does not match !', ''),
(261, 'new_password_at_least_six_character', 'New Password At Least 6 Character.', ''),
(262, 'you_put_wrong_email_address', 'You put wrong email address !', ''),
(263, 'cheque_ammount_asjusted', 'Cheque amount adjusted.', ''),
(264, 'successfully_payment_paid', 'Successfully Payment Paid.', ''),
(265, 'successfully_added', 'Successfully Added.', ''),
(266, 'successfully_updated_2_closing_ammount_not_changeale', 'Successfully Updated -2. Note: Closing Amount Not Changeable.', ''),
(267, 'successfully_payment_received', 'Successfully Payment Received.', ''),
(268, 'already_inserted', 'Already Inserted !', ''),
(269, 'successfully_delete', 'Successfully Delete.', ''),
(270, 'successfully_created', 'Successfully Created.', ''),
(271, 'logo_not_uploaded', 'Logo not uploaded !', ''),
(272, 'favicon_not_uploaded', 'Favicon not uploaded !', ''),
(273, 'supplier_mobile', 'Supplier Mobile', ''),
(274, 'supplier_address', 'Supplier Address', ''),
(275, 'supplier_details', 'Supplier Details', ''),
(276, 'add_new_supplier', 'Add New Supplier', ''),
(277, 'manage_suppiler', 'Manage Supplier', ''),
(278, 'manage_your_supplier', 'Manage your supplier', ''),
(279, 'manage_supplier_ledger', 'Manage supplier ledger', ''),
(280, 'invoice_id', 'Invoice ID', ''),
(281, 'deposite_id', 'Deposite ID', ''),
(282, 'supplier_actual_ledger', 'Supplier Actual Ledger', ''),
(283, 'supplier_information', 'Supplier Information', ''),
(284, 'event', 'Event', ''),
(285, 'add_new_income', 'Add New Income', ''),
(286, 'add_expese', 'Add Expense', ''),
(287, 'add_new_expense', 'Add New Expense', ''),
(288, 'total_inflow_ammount', 'Total Income Amount', ''),
(289, 'create_new_invoice', 'Create New Invoice', ''),
(290, 'create_pos_invoice', 'Create POS Invoice', ''),
(291, 'total_profit', 'Total Profit', ''),
(292, 'monthly_progress_report', 'Monthly Progress Report', ''),
(293, 'total_invoice', 'Total Invoice', ''),
(294, 'account_summary', 'Account Summary', ''),
(295, 'total_supplier', 'Total Supplier', ''),
(296, 'total_product', 'Total Product', ''),
(297, 'total_customer', 'Total Customer', ''),
(298, 'supplier_edit', 'Supplier Edit', ''),
(299, 'add_new_invoice', 'Add New Invoice', ''),
(300, 'add_new_purchase', 'Add new purchase', ''),
(301, 'currency', 'Currency', ''),
(302, 'currency_position', 'Currency Position', ''),
(303, 'left', 'Left', ''),
(304, 'right', 'Right', ''),
(305, 'add_tax', 'Add Tax', ''),
(306, 'manage_tax', 'Manage Tax', ''),
(307, 'add_new_tax', 'Add new tax', ''),
(308, 'enter_tax', 'Enter Tax', ''),
(309, 'already_exists', 'Already Exists !', ''),
(310, 'successfully_inserted', 'Successfully Inserted.', ''),
(311, 'tax', 'Tax', ''),
(312, 'tax_edit', 'Tax Edit', ''),
(313, 'product_not_added', 'Product not added !', ''),
(314, 'total_tax', 'Total Tax', ''),
(315, 'manage_your_supplier_details', 'Manage your supplier details.', ''),
(316, 'invoice_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s                                       standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', ''),
(317, 'thank_you_for_choosing_us', 'Thank you very much for choosing us.', ''),
(318, 'billing_date', 'Billing Date', ''),
(319, 'billing_to', 'Billing To', ''),
(320, 'billing_from', 'Billing From', ''),
(321, 'you_cant_delete_this_product', 'Sorry !!  You can\'t delete this product.This product already used in calculation system!', ''),
(322, 'old_customer', 'Old Customer', ''),
(323, 'new_customer', 'New Customer', ''),
(324, 'new_supplier', 'New Supplier', ''),
(325, 'old_supplier', 'Old Supplier', ''),
(326, 'credit_customer', 'Credit Customer', ''),
(327, 'account_already_exists', 'This Account Already Exists !', ''),
(328, 'edit_income', 'Edit Income', ''),
(329, 'you_are_not_access_this_part', 'You are not authorised person !', ''),
(330, 'account_edit', 'Account Edit', ''),
(331, 'due', 'Due', ''),
(332, 'expense_edit', 'Expense Edit', ''),
(333, 'please_select_customer', 'Please select customer !', ''),
(334, 'profit_report', 'Profit Report (Invoice Wise)', ''),
(335, 'total_profit_report', 'Total profit report', ''),
(336, 'please_enter_valid_captcha', 'Please enter valid captcha.', ''),
(337, 'category_not_selected', 'Category not selected.', ''),
(338, 'supplier_not_selected', 'Supplier not selected.', ''),
(339, 'please_select_product', 'Please select product.', ''),
(340, 'product_model_already_exist', 'Product model already exist !', ''),
(341, 'invoice_logo', 'Invoice Logo', ''),
(342, 'available_ctn', 'Available Ctn.', ''),
(343, 'you_can_not_buy_greater_than_available_cartoon', 'You can not select grater than available cartoon !', ''),
(344, 'customer_details', 'Customer details', ''),
(345, 'manage_customer_details', 'Manage customer details.', ''),
(346, 'site_key', 'Captcha Site Key', ''),
(347, 'secret_key', 'Captcha Secret Key', ''),
(348, 'captcha', 'Captcha', ''),
(349, 'cartoon_quantity', 'Carton Quantity', ''),
(350, 'total_cartoon', 'Total Cartoon', ''),
(351, 'cartoon', 'Carton', ''),
(352, 'item_cartoon', 'Item/Cartoon', ''),
(353, 'product_and_supplier_did_not_match', 'Product and supplier did not match !', ''),
(354, 'if_you_update_purchase_first_select_supplier_then_product_and_then_cartoon', 'If you update purchase,first select supplier then product and then update cartoon.', ''),
(355, 'item', 'Item', ''),
(356, 'manage_your_credit_customer', 'Manage your credit customer', ''),
(357, 'total_quantity', 'Total Quantity', ''),
(358, 'quantity_per_cartoon', 'Qnt per carton', ''),
(359, 'barcode_qrcode_scan_here', 'Barcode or QR-code scan here', ''),
(360, 'synchronizer_setting', 'Synchronizer Setting', ''),
(361, 'data_synchronizer', 'Data Synchronizer', ''),
(362, 'hostname', 'Host name', ''),
(363, 'username', 'User Name', ''),
(364, 'ftp_port', 'FTP Port', ''),
(365, 'ftp_debug', 'FTP Debug', ''),
(366, 'project_root', 'Project Root', ''),
(367, 'please_try_again', 'Please try again', ''),
(368, 'save_successfully', 'Save successfully', ''),
(369, 'synchronize', 'Synchronize', ''),
(370, 'internet_connection', 'Internet Connection', ''),
(371, 'outgoing_file', 'Outgoing File', ''),
(372, 'incoming_file', 'Incoming File', ''),
(373, 'ok', 'Ok', ''),
(374, 'not_available', 'Not Available', ''),
(375, 'available', 'Available', ''),
(376, 'download_data_from_server', 'Download data from server', ''),
(377, 'data_import_to_database', 'Data import to database', ''),
(378, 'data_upload_to_server', 'Data uplod to server', ''),
(379, 'please_wait', 'Please Wait', ''),
(380, 'ooops_something_went_wrong', 'Oooops Something went wrong !', ''),
(381, 'upload_successfully', 'Upload successfully', ''),
(382, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file please check configuration', ''),
(383, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', ''),
(384, 'download_successfully', 'Download successfully', ''),
(385, 'unable_to_download_file_please_check_configuration', 'Unable to download file please check configuration', ''),
(386, 'data_import_first', 'Data import past', ''),
(387, 'data_import_successfully', 'Data import successfully', ''),
(388, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data please check config or sql file', ''),
(389, 'total_sale_ctn', 'Total Sale Ctn', ''),
(390, 'in_ctn', 'In Ctn.', ''),
(391, 'out_ctn', 'Out Ctn.', ''),
(392, 'stock_report_supplier_wise', 'Stock Report (Supplier Wise)', ''),
(393, 'all_stock_report_supplier_wise', 'Stock Report (Suppler Wise)', ''),
(394, 'select_supplier', 'Select Supplier', ''),
(395, 'stock_report_product_wise', 'Stock Report (Product Wise)', ''),
(396, 'phone', 'Phone', 'ÃƒÂ Ã‚Â¦Ã‚Â«ÃƒÂ Ã‚Â§Ã¢â‚¬Â¹ÃƒÂ Ã‚Â¦Ã‚Â¨'),
(397, 'select_product', 'Select Product', NULL),
(398, 'in_quantity', 'In Qnty.', NULL),
(399, 'out_quantity', 'Out Qnty.', NULL),
(400, 'in_taka', 'In TK.', NULL),
(401, 'out_taka', 'Out TK.', NULL),
(402, 'commission', 'Commission', NULL),
(403, 'generate_commission', 'Generate Commssion', NULL),
(404, 'commission_rate', 'Commission Rate', NULL),
(405, 'total_ctn', 'Total Ctn.', NULL),
(406, 'per_pcs_commission', 'Per PCS Commission', NULL),
(407, 'total_commission', 'Total Commission', NULL),
(408, 'enter', 'Enter', NULL),
(409, 'please_add_walking_customer_for_default_customer', 'Please add \'Walking Customer\' for default customer.', NULL),
(410, 'supplier_ammount', 'Supplier Amount', NULL),
(411, 'my_sale_ammount', 'My Sale Amount', NULL),
(412, 'signature_pic', 'Signature Picture', NULL),
(413, 'branch', 'Branch', NULL),
(414, 'ac_no', 'A/C Number', NULL),
(415, 'ac_name', 'A/C Name', NULL),
(416, 'bank_debit_credit_manage', 'Bank Dr. And Cr. Manage', NULL),
(417, 'bank', 'Bank', NULL),
(418, 'withdraw_deposite_id', 'Withdraw / Deposite ID', NULL),
(419, 'bank_ledger', 'Bank Ledger', NULL),
(420, 'note_name', 'Note Name', NULL),
(421, 'pcs', 'Pcs.', NULL),
(422, '1', '1', NULL),
(423, '2', '2', NULL),
(424, '5', '5', NULL),
(425, '10', '10', NULL),
(426, '20', '20', NULL),
(427, '50', '50', NULL),
(428, '100', '100', NULL),
(429, '500', '500', NULL),
(430, '1000', '1000', NULL),
(431, 'total_discount', 'Total Discount', NULL),
(432, 'product_not_found', 'Product not found !', NULL),
(433, 'this_is_not_credit_customer', 'This is not credit customer !', NULL),
(434, 'personal_loan', 'Office Loan', NULL),
(435, 'add_person', 'Add Person', NULL),
(436, 'add_loan', 'Add Loan', NULL),
(437, 'add_payment', 'Add Payment', NULL),
(438, 'manage_person', 'Manage Person', NULL),
(439, 'personal_edit', 'Person Edit', NULL),
(440, 'person_ledger', 'Person Ledger', NULL),
(441, 'backup_restore', 'Backup and restore', NULL),
(442, 'database_backup', 'Database backup', NULL),
(443, 'file_information', 'File information', NULL),
(444, 'filename', 'Filename', NULL),
(445, 'size', 'Size', NULL),
(446, 'backup_date', 'Backup date', NULL),
(447, 'backup_now', 'Backup now', NULL),
(448, 'restore_now', 'Restore now', NULL),
(449, 'are_you_sure', 'Are you sure ?', NULL),
(450, 'download', 'Download', NULL),
(451, 'backup_and_restore', 'Backup and restore', NULL),
(452, 'backup_successfully', 'Backup successfully', NULL),
(453, 'delete_successfully', 'Delete successfully', NULL),
(454, 'stock_ctn', 'Stock/Qnt', NULL),
(455, 'unit', 'Unit', NULL),
(456, 'meter_m', 'Meter (M)', NULL),
(457, 'piece_pc', 'Piece (Pc)', NULL),
(458, 'kilogram_kg', 'Kilogram (Kg)', NULL),
(459, 'stock_cartoon', 'Stock Cartoon', NULL),
(460, 'add_product_csv', 'Add Product (CSV)', NULL),
(461, 'import_product_csv', 'Import product (CSV)', NULL),
(462, 'close', 'Close', NULL),
(463, 'download_example_file', 'Download example file.', NULL),
(464, 'upload_csv_file', 'Upload CSV File', NULL),
(465, 'csv_file_informaion', 'CSV File Information', NULL),
(466, 'out_of_stock', 'Out Of Stock', NULL),
(467, 'others', 'Others', NULL),
(468, 'full_paid', 'Full Paid', NULL),
(469, 'successfully_saved', 'Your Data Successfully Saved', NULL),
(470, 'manage_loan', 'Manage Loan', NULL),
(471, 'receipt', 'Receipt', NULL),
(472, 'payment', 'Payment', NULL),
(473, 'cashflow', 'Daily Cash Flow', NULL),
(474, 'signature', 'Signature', NULL),
(475, 'supplier_reports', 'Supplier Reports', NULL),
(476, 'generate', 'Generate', NULL),
(477, 'save_change', 'Save Change', NULL),
(478, 'loan_edit', 'Edit loan', NULL),
(479, 'ac_number', 'A/C Number', NULL),
(480, 'bank_transection', 'Bank transaction', NULL),
(481, 'total_purch_ctn', 'Total P Cartoon', NULL),
(482, 'supplier_actual_saleprice', 'Supplier Actual sales', NULL),
(483, 'supplier_payment_ledger', 'Supplier Payment', NULL),
(484, 'supplier_actual_ledger_sale', 'Supplier Actual Ledger(sale)', NULL),
(485, 'supplier_actual_ledger_sup', 'Supplier Actual Ledger(supplier)', NULL),
(486, 'supplier_payment', 'Supplier Payment', NULL),
(487, 'supplier_summary', 'Supplier Summary', NULL),
(488, 'create_account', 'Create Account', NULL),
(489, 'manage_transaction', 'Manage transaction', NULL),
(490, 'daily_summary', 'Daily Summary', NULL),
(491, 'daily_cashflow', 'Daily Cashflow', NULL),
(492, 'custom_report', 'Custom report', NULL),
(493, 'transaction', 'Transaction', NULL),
(494, 'add_new_payment', 'Add new payment', NULL),
(495, 'add_receipt', 'Add receipt', NULL),
(496, 'add_new_receipt', 'Add new receipt', NULL),
(497, 'receipt_amount', 'Receipt amount', NULL),
(498, 'transaction_details', 'Transaction details', NULL),
(499, 'choose_transaction', 'Choose transaction', NULL),
(500, 'transaction_categry', 'Transaction Category', NULL),
(501, 'select_account', 'Select Account', NULL),
(502, 'transaction_mood', 'Transaction Mood', NULL),
(503, 'payment_amount', 'Payment Amount', NULL),
(504, 'personal_loan1', 'Personal Loan', NULL),
(505, 'company_name_label', 'Company name', NULL),
(506, 'root_account', 'Root Account', NULL),
(507, 'cash_receipt', 'Cash Receipt', NULL),
(508, 'customer_copy', 'Customer Copy', NULL),
(509, 'office_copy', 'Office Copy', NULL),
(510, 'office', 'Office', NULL),
(511, 'loan', 'Loan', NULL),
(512, 'total_debit', 'Total Dr.', NULL),
(513, 'total_credit', 'Total Cr.', NULL),
(514, 'total_balance', 'Total Balance', NULL),
(515, 'already_close', 'Already close, for this day!', NULL),
(516, 'backup', 'Data Backup', NULL);

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `cash_date` varchar(20) NOT NULL,
  `1000n` varchar(11) NOT NULL,
  `500n` varchar(11) NOT NULL,
  `100n` varchar(11) NOT NULL,
  `50n` varchar(11) NOT NULL,
  `20n` varchar(11) NOT NULL,
  `10n` varchar(11) NOT NULL,
  `5n` varchar(11) NOT NULL,
  `2n` varchar(11) NOT NULL,
  `1n` varchar(30) NOT NULL,
  `grandtotal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `outflow_1td1fz8uvv`
--

CREATE TABLE `outflow_1td1fz8uvv` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `outflow_pt3vxiow9x`
--

CREATE TABLE `outflow_pt3vxiow9x` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Table structure for table `personal_loan`
--

CREATE TABLE `personal_loan` (
  `per_loan_id` int(11) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `person_id` varchar(30) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `date` varchar(30) NOT NULL,
  `details` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Table structure for table `person_information`
--

CREATE TABLE `person_information` (
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(50) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Table structure for table `person_ledger`
--

CREATE TABLE `person_ledger` (
  `transaction_id` varchar(50) NOT NULL,
  `person_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `pesonal_loan_information`
--

CREATE TABLE `pesonal_loan_information` (
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(30) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `status`) VALUES
('PODIV6PPYYK3XWY', 'Mobile', 1),
('NVSFV5KFXH7X79V', 'Computer', 1),
('GPU3H83D2PLUFE3', 'Electronics', 1),
('IO7XJTTFNLNQPR8', 'Bag', 1),
('TGEAY5HOIITL4RG', 'Cloths', 1),
('AHEJBCMOWMAM57J', 'Medicine', 1),
('8F1RKMMW3P2QEVB', 'Flowers', 1);


--
-- Table structure for table `product_information`
--

CREATE TABLE `product_information` (
  `product_id` varchar(100) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `supplier_price` float DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `cartoon_quantity` int(11) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `product_model` varchar(100) NOT NULL,
  `product_details` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_information`
--

INSERT INTO `product_information` (`product_id`, `supplier_id`, `category_id`, `product_name`, `price`, `supplier_price`, `unit`, `cartoon_quantity`, `tax`, `product_model`, `product_details`, `image`, `status`) VALUES
('86875793', 'E9QLSAJKQW3T776FNBTA', 'GPU3H83D2PLUFE3', 'OPOLAR 6700mAh Battery ', 850, 720, NULL, 20, 0, 'OPL-101', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/85fd2c25f07c73a4ca401e8c93c198de.jpg', 1),
('26647817', '2HGZE2X3IYX2CNSBNP7M', 'GPU3H83D2PLUFE3', 'Portable Fan', 999, 810, NULL, 12, 0, 'PF-102', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/be0a93f328143c5ec251b858090819ee.jpg', 1),
('23752845', 'CUQKAQKOGWFG415K4JNH', 'GPU3H83D2PLUFE3', 'Fitness Tracker', 550, 490, NULL, 15, 0, 'FT-103', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/b9e8754e52eb2b08343cd395f57b6bb0.jpg', 1),
('39147222', 'CSY3TV336OVF5GDV9V26', 'PODIV6PPYYK3XWY', 'Bike Phone', 1590, 1400, NULL, 10, 0, 'BP-104', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/f175d06960c97f19870a01284844ebd9.jpg', 1),
('74261881', '5QMYOGM67F75WOIQRTJ7', 'NVSFV5KFXH7X79V', 'Laptop stand', 890, 750, NULL, 15, 0, 'LS-105', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/4f10c066967594a8c5637efc5c40044c.jpg', 1),
('86119874', '3AVWF1P92SCLEJIY9HUZ', 'PODIV6PPYYK3XWY', 'Okra Bike Phone', 1250, 1100, NULL, 12, 0, 'OBP-106', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/769f41fb14292d62ed4c9acdea4ff27a.jpg', 1),
('11886213', '3J84BY6GVWQYZMHARF8P', 'NVSFV5KFXH7X79V', 'Acer Aspire E 15', 12500, 10000, NULL, 20, 0, 'AA-107', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/4b8b582f557d6423fea6620a8b569467.jpg', 1),
('63245498', '3AVWF1P92SCLEJIY9HUZ', 'NVSFV5KFXH7X79V', 'Acer Chromebook', 22000, 20000, NULL, 12, 0, 'AC-108', 'Acer Chromebook 11, Celeron N3060, 11.6\" HD, 4GB DDR3L, 16GB Storage, CB3-132-C4VV', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/63b1a77e862feb4dc37152f422258457.jpg', 1),
('48118641', '3RQGMYJWALNA2UPRVYH3', 'GPU3H83D2PLUFE3', 'AmazonBasics D Cell', 520, 410, NULL, 20, 0, 'AMD-109', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/ba09f7095c096f730aa2b7c2d3c4f943.jpg', 1),
('72118779', '2HGZE2X3IYX2CNSBNP7M', 'GPU3H83D2PLUFE3', 'Oral-B Pro', 250, 140, NULL, 20, 0, 'OB-110', '', 'http://wholesalenew.bdtask.com/wholsaledemov5.3/my-assets/image/product/5d6fe882181f323d7d9e622a79b69170.jpg', 1);


--
-- Table structure for table `product_purchase`
--

CREATE TABLE `product_purchase` (
  `purchase_id` varchar(100) NOT NULL,
  `chalan_no` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `grand_total_amount` float NOT NULL,
  `purchase_date` varchar(50) NOT NULL,
  `purchase_details` text NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Dumping data for table `product_purchase`
--

INSERT INTO `product_purchase` (`purchase_id`, `chalan_no`, `supplier_id`, `grand_total_amount`, `purchase_date`, `purchase_details`, `status`) VALUES
('20181002093610', 'BD-001', 'CUQKAQKOGWFG415K4JNH', 110250, '2018-10-02', '', 1),
('20181002093628', 'BD-002', '5QMYOGM67F75WOIQRTJ7', 337500, '2018-10-02', '', 1),
('20181002093645', 'BD-003', '5QMYOGM67F75WOIQRTJ7', 281250, '2018-10-02', '', 1),
('20181002093711', 'BD-004', '2HGZE2X3IYX2CNSBNP7M', 201800, '2018-10-02', '', 1),
('20181002093730', 'BD-005', '3J84BY6GVWQYZMHARF8P', 3000000, '2018-10-02', '', 1),
('20181002093803', 'BD-006', '3RQGMYJWALNA2UPRVYH3', 123000, '2018-10-02', '', 1),
('20181002093827', 'BD-007', '3AVWF1P92SCLEJIY9HUZ', 3078000, '2018-10-02', '', 1),
('20181002093927', 'BD-008', 'CSY3TV336OVF5GDV9V26', 280000, '2018-10-02', '', 1),
('20181002094017', 'BD-009', 'E9QLSAJKQW3T776FNBTA', 216000, '2018-10-02', '', 1);

--
-- Table structure for table `product_purchase_details`
--

CREATE TABLE `product_purchase_details` (
  `purchase_detail_id` varchar(100) NOT NULL,
  `purchase_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_purchase_details`
--

INSERT INTO `product_purchase_details` (`purchase_detail_id`, `purchase_id`, `product_id`, `quantity`, `rate`, `total_amount`, `status`) VALUES
('XczHDcPqkyRdXMc', '20181002093610', '23752845', 225, 490, 110250, 1),
('WlTHthSarGRgJAN', '20181002093628', '74261881', 450, 750, 337500, 1),
('STTqd6TF5VsMoHl', '20181002093645', '74261881', 375, 750, 281250, 1),
('TsBnFSGk2JFAaf3', '20181002093711', '26647817', 180, 810, 145800, 1),
('TR6lPK6QXOR3wfS', '20181002093711', '72118779', 400, 140, 56000, 1),
('N6Tgg8lekqxb6EB', '20181002093730', '11886213', 300, 10000, 3000000, 1),
('LZ7cP2RMBVvcbuX', '20181002093803', '48118641', 300, 410, 123000, 1),
('5aTBvsGn4IWuz0m', '20181002093827', '86119874', 180, 1100, 198000, 1),
('pyoi4YzrRYp2cqD', '20181002093827', '63245498', 144, 20000, 2880000, 1),
('JZysWByIwHXKYYT', '20181002093927', '39147222', 200, 1400, 280000, 1),
('TbKmb1crqcD1VxH', '20181002094017', '86875793', 300, 720, 216000, 1);



--
-- Table structure for table `supplier_information`
--

CREATE TABLE `supplier_information` (
  `supplier_id` varchar(100) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `details` varchar(255) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_information`
--

INSERT INTO `supplier_information` (`supplier_id`, `supplier_name`, `address`, `mobile`, `details`, `status`) VALUES
('5OVM1RGEJSZT928SRIKT', 'Jack', 'London', '8465451361', '', 1),
('CUQKAQKOGWFG415K4JNH', 'Harry', 'America', '01845563256', '', 1),
('5QMYOGM67F75WOIQRTJ7', 'Thomas', 'Japan', '156464654', '', 1),
('2HGZE2X3IYX2CNSBNP7M', 'Oscar', 'Eskaton', '654651164', '', 1),
('3J84BY6GVWQYZMHARF8P', 'James', 'New Yourk', '164981561', '', 1),
('3RQGMYJWALNA2UPRVYH3', 'George', 'Hydrabad', '5466546', '', 1),
('3AVWF1P92SCLEJIY9HUZ', 'Jacob', 'Nepal', '1646846841', '', 1),
('SGDXRS1N7JD3S6W8LCKF', 'Alexander', 'South Africa', '5275877', '', 1),
('CSY3TV336OVF5GDV9V26', 'Michael', 'India', '51654654', '', 1),
('E9QLSAJKQW3T776FNBTA', 'Liam', 'India', '524134131', '', 1);

--
-- Table structure for table `supplier_ledger`
--

CREATE TABLE `supplier_ledger` (
  `transaction_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `chalan_no` varchar(100) DEFAULT NULL,
  `deposit_no` varchar(50) DEFAULT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `d_c` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_ledger`
--

INSERT INTO `supplier_ledger` (`transaction_id`, `supplier_id`, `chalan_no`, `deposit_no`, `amount`, `description`, `payment_type`, `cheque_no`, `date`, `status`, `d_c`) VALUES
('2018100233', '5OVM1RGEJSZT928SRIKT', '201810023311', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100233', 'CUQKAQKOGWFG415K4JNH', '201810023345', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100234', '5QMYOGM67F75WOIQRTJ7', '201810023413', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100234', '2HGZE2X3IYX2CNSBNP7M', '201810023450', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100235', '3J84BY6GVWQYZMHARF8P', '201810023518', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100203', '3RQGMYJWALNA2UPRVYH3', '201810020327', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100203', '3AVWF1P92SCLEJIY9HUZ', '201810020347', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100204', 'SGDXRS1N7JD3S6W8LCKF', '201810020417', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100204', 'CSY3TV336OVF5GDV9V26', '201810020444', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('2018100205', 'E9QLSAJKQW3T776FNBTA', '201810020527', NULL, 0, 'Previous Balance', '', '', '2018-10-02', 1, 'c'),
('20181002093610', 'CUQKAQKOGWFG415K4JNH', 'BD-001', NULL, 110250, '', '', '', '2018-10-02', 1, 'c'),
('20181002093628', '5QMYOGM67F75WOIQRTJ7', 'BD-002', NULL, 337500, '', '', '', '2018-10-02', 1, 'c'),
('20181002093645', '5QMYOGM67F75WOIQRTJ7', 'BD-003', NULL, 281250, '', '', '', '2018-10-02', 1, 'c'),
('20181002093711', '2HGZE2X3IYX2CNSBNP7M', 'BD-004', NULL, 201800, '', '', '', '2018-10-02', 1, 'c'),
('20181002093730', '3J84BY6GVWQYZMHARF8P', 'BD-005', NULL, 3000000, '', '', '', '2018-10-02', 1, 'c'),
('20181002093803', '3RQGMYJWALNA2UPRVYH3', 'BD-006', NULL, 123000, '', '', '', '2018-10-02', 1, 'c'),
('20181002093827', '3AVWF1P92SCLEJIY9HUZ', 'BD-007', NULL, 3078000, '', '', '', '2018-10-02', 1, 'c'),
('20181002093927', 'CSY3TV336OVF5GDV9V26', 'BD-008', NULL, 280000, '', '', '', '2018-10-02', 1, 'c'),
('20181002094017', 'E9QLSAJKQW3T776FNBTA', 'BD-009', NULL, 216000, '', '', '', '2018-10-02', 1, 'c'),
('NYUVG9Z2W7DKNAE', 'SGDXRS1N7JD3S6W8LCKF', NULL, 'DR5R6H5V1Q', 15000, '', '1', '', '2018-10-02', 1, 'd'),
('F8QTT3QKLO9EL96', 'E9QLSAJKQW3T776FNBTA', NULL, '5RYLPMQM5C', 8000, '', '1', '', '2018-10-02', 1, 'd'),
('3GF4QJCKMR41BBE', 'CUQKAQKOGWFG415K4JNH', NULL, '5UCPCDJJID', 9500, '', '1', '', '2018-10-02', 1, 'd'),
('2DWUB9FBG831DWF', 'CSY3TV336OVF5GDV9V26', NULL, '57SQS2JWP4', 56555, '', '1', '', '2018-10-02', 1, 'd'),
('YWTL5DWTPV5M5VW', '5QMYOGM67F75WOIQRTJ7', NULL, 'GG5ECX4ZJF', 15000, '', '1', '', '2018-10-02', 1, 'd'),
('HV6D1Y6DXXYWU4I', '2HGZE2X3IYX2CNSBNP7M', NULL, 'WNMU3L1OH4', 8200, '', '1', '', '2018-10-02', 1, 'd'),
('WQCH33JIHVDES1E', '3AVWF1P92SCLEJIY9HUZ', NULL, 'U8ODKP11R8', 5000, '', '1', '', '2018-10-02', 1, 'd'),
('8B1H9PN8KG5NNJN', '3RQGMYJWALNA2UPRVYH3', NULL, '4VFQL9PNZX', 8400, '', '1', '', '2018-10-02', 1, 'd'),
('WGKY3LMOCBUDBDR', '3J84BY6GVWQYZMHARF8P', NULL, 'JS4GSR4Y2U', 12500, '', '1', '', '2018-10-02', 1, 'd'),
('WWKA8J1M7WXOQTZ', 'CSY3TV336OVF5GDV9V26', NULL, '7T1S3HFQSF', 2000, '', '1', '', '2018-10-02', 1, 'd');

--
-- Table structure for table `synchronizer_setting`
--

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `tax_information`
--

CREATE TABLE `tax_information` (
  `tax_id` varchar(15) NOT NULL,
  `tax` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Table structure for table `transection`
--

CREATE TABLE `transection` (
  `transaction_id` varchar(30) NOT NULL,
  `date_of_transection` varchar(30) NOT NULL,
  `transection_type` varchar(30) NOT NULL,
  `transection_category` varchar(30) NOT NULL,
  `transection_mood` varchar(25) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `pay_amount` int(30) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `relation_id` varchar(30) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `transection`
--

INSERT INTO `transection` (`transaction_id`, `date_of_transection`, `transection_type`, `transection_category`, `transection_mood`, `amount`, `pay_amount`, `description`, `relation_id`, `create_date`) VALUES
('NYUVG9Z2W7DKNAE', '2018-10-02', '1', '1', '1', '', 15000, '', 'SGDXRS1N7JD3S6W8LCKF', '2018-10-02 09:45:35'),
('F8QTT3QKLO9EL96', '2018-10-02', '1', '1', '1', '', 8000, '', 'E9QLSAJKQW3T776FNBTA', '2018-10-02 09:46:05'),
('3GF4QJCKMR41BBE', '2018-10-02', '1', '1', '1', '', 9500, '', 'CUQKAQKOGWFG415K4JNH', '2018-10-02 09:46:58'),
('2DWUB9FBG831DWF', '2018-10-02', '1', '1', '1', '', 56555, '', 'CSY3TV336OVF5GDV9V26', '2018-10-02 09:47:28'),
('YWTL5DWTPV5M5VW', '2018-10-02', '1', '1', '1', '', 15000, '', '5QMYOGM67F75WOIQRTJ7', '2018-10-02 09:47:54'),
('HV6D1Y6DXXYWU4I', '2018-10-02', '1', '1', '1', '', 8200, '', '2HGZE2X3IYX2CNSBNP7M', '2018-10-02 09:48:09'),
('WQCH33JIHVDES1E', '2018-10-02', '1', '1', '1', '', 5000, '', '3AVWF1P92SCLEJIY9HUZ', '2018-10-02 09:48:26'),
('8B1H9PN8KG5NNJN', '2018-10-02', '1', '1', '1', '', 8400, '', '3RQGMYJWALNA2UPRVYH3', '2018-10-02 09:48:49'),
('WGKY3LMOCBUDBDR', '2018-10-02', '1', '1', '1', '', 12500, '', '3J84BY6GVWQYZMHARF8P', '2018-10-02 09:49:37'),
('BUE6ZXI5M9SNNWG', '2018-10-02', '2', '2', '1', '73200', NULL, 'Cash Paid By Customer', 'L2Q546BXXJ894VY', '2018-10-02 09:50:45'),
('I11Z8S3VN2EN9AD', '2018-10-02', '2', '2', '1', '30000', NULL, 'Cash Paid By Customer', 'VKOJYW6J9KEE5V2', '2018-10-02 09:51:40'),
('V6UTMG9J6NLXT3Z', '2018-10-02', '2', '2', '1', '25000', NULL, 'Cash Paid By Customer', '7K9KDEPKD1SLNI3', '2018-10-02 09:52:02'),
('LKUWRTOWS6U6MPC', '2018-10-02', '2', '2', '1', '14000', NULL, 'Cash Paid By Customer', '24P51HOXDQ57OI8', '2018-10-02 09:52:34'),
('LNXTMGB6HVNMGRQ', '2018-10-02', '2', '2', '1', '50000', NULL, 'Cash Paid By Customer', 'TYFGJDZ5B8DTTUJ', '2018-10-02 09:53:11'),
('NFTJMJN6STAMZLX', '2018-10-02', '2', '2', '1', '16000', NULL, 'Cash Paid By Customer', 'TPW4DFJMTN2PFNI', '2018-10-02 09:53:45'),
('2CQM973QST9F539', '2018-10-02', '2', '2', '1', '30000', NULL, 'Cash Paid By Customer', 'CQ6GEO12JT8WNQC', '2018-10-02 09:54:21'),
('CYGVVUL6LWX2HII', '2018-10-02', '2', '2', '1', '17000', NULL, 'Cash Paid By Customer', 'SKI9P4ZGEZ6YRK7', '2018-10-02 09:55:07'),
('FZGBWVVSMHSEOQM', '2018-10-02', '2', '2', '1', '20000', NULL, 'Cash Paid By Customer', 'VKOJYW6J9KEE5V2', '2018-10-02 09:56:08'),
('EUK6FHHQAXMPGF9', '2018-10-02', '2', '2', '1', '25000', NULL, 'Cash Paid By Customer', 'TYFGJDZ5B8DTTUJ', '2018-10-02 09:57:04'),
('WWKA8J1M7WXOQTZ', '2018-10-02', '1', '1', '1', '', 2000, '', 'CSY3TV336OVF5GDV9V26', '2018-10-02 10:02:40'),
('IWD7UEDJQAMHAUW', '2018-10-02', '2', '2', '1', '1000', 0, '', 'VKOJYW6J9KEE5V2', '2018-10-02 10:03:30');

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(15) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `gender` int(2) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `gender`, `date_of_birth`, `logo`, `status`) VALUES
('1', 'doey', 'johan', 1, '', 'http://wholesalenew.bdtask.com/newholesale/assets/dist/img/profile_picture/ecfa48146fe62fe3f8444bff19a6a9f7.jpg', 1),
('12', 'Austin', 'JOhn', 1, '', 'http://wholesalenew.bdtask.com/newholesale/assets/dist/img/profile_picture/5fe24208f4e6627b870a17df72c3e3a2.png', 1),
('11', 'fok', 'joy', 0, '', NULL, 1),
('s3RXF8VkQc5mSXc', 'buyer', 'test', 0, '', NULL, 1),
('NCdacXvlPA8lz6C', 'ss', 'sss', 0, '', NULL, 0),
('ec5Yp5y5GB1q8b8', 'SDFJSDFH', 'O Mamma', 0, '', NULL, 1);
--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(2) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `username`, `password`, `user_type`, `security_code`, `status`) VALUES
('12', 'user@gmail.com', '41d99b369894eb1ec3f461135132d8bb', 2, '', 1),
('11', 'jone.doe@gmail.com', '41d99b369894eb1ec3f461135132d8bb', 2, '', 1),
('1', 'test@test.com', '41d99b369894eb1ec3f461135132d8bb', 1, '', 1),
('s3RXF8VkQc5mSXc', 'te@gmail.com', '9778b8de77bfecacc8f7ad56117fd4f9', 2, '', 1),
('NCdacXvlPA8lz6C', 'tuhinsorker@gmail.com', '7a934349f40efba772beb2132a34365a', 2, '', 0),
('ec5Yp5y5GB1q8b8', 'ARA@ggg.com', '912ec803b2ce49e4a541068d495ab570', 1, '', 1);


--
-- Stand-in structure for view `customer_transection_summary`
-- (See below for the actual view)
--
CREATE TABLE `customer_transection_summary` (
`customer_name` varchar(255)
,`customer_id` varchar(100)
,`type` varchar(6)
,`amount` double
);

--
-- Stand-in structure for view `product_report`
-- (See below for the actual view)
--
CREATE TABLE `product_report` (
`date` varchar(50)
,`product_id` varchar(100)
,`quantity` double
,`rate` float
,`total_amount` double
,`account` varchar(1)
);


--
-- Stand-in structure for view `product_supplier`
-- (See below for the actual view)
--
CREATE TABLE `product_supplier` (
`product_id` varchar(100)
,`product_name` varchar(255)
,`product_model` varchar(100)
,`supplier_id` varchar(100)
);



--
-- Stand-in structure for view `purchase_report`
-- (See below for the actual view)
--
CREATE TABLE `purchase_report` (
`purchase_date` varchar(50)
,`chalan_no` varchar(100)
,`supplier_id` varchar(100)
,`purchase_detail_id` varchar(100)
,`purchase_id` varchar(100)
,`product_id` varchar(100)
,`quantity` int(11)
,`rate` float
,`total_amount` float
,`status` int(11)
);


--
-- Stand-in structure for view `sales_actual`
-- (See below for the actual view)
--
CREATE TABLE `sales_actual` (
`DATE` varchar(50)
,`supplier_id` varchar(100)
,`sub_total` double
,`no_transection` varchar(255)
);



--
-- Stand-in structure for view `sales_report`
-- (See below for the actual view)
--
CREATE TABLE `sales_report` (
`date` varchar(50)
,`invoice_id` varchar(100)
,`invoice_details_id` varchar(100)
,`customer_id` varchar(100)
,`supplier_id` varchar(100)
,`product_id` varchar(100)
,`product_model` varchar(100)
,`product_name` varchar(255)
,`cartoon` float
,`quantity` float
,`sell_rate` float
,`supplier_rate` float
);



--
-- Stand-in structure for view `stock_history`
-- (See below for the actual view)
--
CREATE TABLE `stock_history` (
`vdate` varchar(50)
,`product_id` varchar(100)
,`sell` double
,`Purchase` decimal(32,0)
);

--
-- Stand-in structure for view `view_customer_transection`
-- (See below for the actual view)
--
CREATE TABLE `view_customer_transection` (
`transaction_id` varchar(30)
,`customer_name` varchar(255)
,`invoice_no` varchar(100)
,`receipt_no` varchar(50)
);


--
-- Stand-in structure for view `view_person_transection`
-- (See below for the actual view)
--
CREATE TABLE `view_person_transection` (
`transaction_id` varchar(30)
,`person_name` varchar(50)
);



--
-- Stand-in structure for view `view_supplier_transection`
-- (See below for the actual view)
--
CREATE TABLE `view_supplier_transection` (
`transaction_id` varchar(30)
,`supplier_name` varchar(255)
);



--
-- Stand-in structure for view `view_transection`
-- (See below for the actual view)
--
CREATE TABLE `view_transection` (
`transaction_id` varchar(30)
,`date_of_transection` varchar(30)
,`amount` varchar(20)
,`pay_amount` int(30)
,`invoice_no` varchar(100)
,`customer_name` varchar(255)
,`supplier_name` varchar(255)
,`person_name` varchar(50)
,`transection_category` varchar(30)
,`transection_type` varchar(30)
,`transection_mood` varchar(25)
,`description` varchar(255)
,`relation_id` varchar(30)
);



--
-- Structure for view `customer_transection_summary`
--
DROP TABLE IF EXISTS `customer_transection_summary`;

CREATE VIEW `customer_transection_summary`  AS  select `customer_information`.`customer_name` AS `customer_name`,`customer_ledger`.`customer_id` AS `customer_id`,'credit' AS `type`,sum(-(`customer_ledger`.`amount`)) AS `amount` from (`customer_ledger` join `customer_information` on((`customer_information`.`customer_id` = `customer_ledger`.`customer_id`))) where (isnull(`customer_ledger`.`receipt_no`) and (`customer_ledger`.`status` = 1)) group by `customer_ledger`.`customer_id` union all select `customer_information`.`customer_name` AS `customer_name`,`customer_ledger`.`customer_id` AS `customer_id`,'debit' AS `type`,sum(`customer_ledger`.`amount`) AS `amount` from (`customer_ledger` join `customer_information` on((`customer_information`.`customer_id` = `customer_ledger`.`customer_id`))) where (isnull(`customer_ledger`.`invoice_no`) and (`customer_ledger`.`status` = 1)) group by `customer_ledger`.`customer_id` ;

-- --------------------------------------------------------

--
-- Structure for view `product_report`
--
DROP TABLE IF EXISTS `product_report`;

CREATE VIEW `product_report`  AS  select `purchase_report`.`purchase_date` AS `date`,`purchase_report`.`product_id` AS `product_id`,`purchase_report`.`quantity` AS `quantity`,`purchase_report`.`rate` AS `rate`,`purchase_report`.`total_amount` AS `total_amount`,'a' AS `account` from `purchase_report` union all select `sales_report`.`date` AS `date`,`sales_report`.`product_id` AS `product_id`,-(`sales_report`.`quantity`) AS `-quantity`,`sales_report`.`supplier_rate` AS `rate`,(`sales_report`.`quantity` * `sales_report`.`supplier_rate`) AS `total_amount`,'b' AS `account` from `sales_report` ;

-- --------------------------------------------------------

--
-- Structure for view `product_supplier`
--
DROP TABLE IF EXISTS `product_supplier`;

CREATE VIEW `product_supplier`  AS  select `b`.`product_id` AS `product_id`,`c`.`product_name` AS `product_name`,`c`.`product_model` AS `product_model`,`a`.`supplier_id` AS `supplier_id` from ((`product_purchase` `a` join `product_purchase_details` `b`) join `product_information` `c`) where ((`a`.`purchase_id` = `b`.`purchase_id`) and (`c`.`product_id` = `b`.`product_id`)) group by `b`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `purchase_report`
--
DROP TABLE IF EXISTS `purchase_report`;

CREATE VIEW `purchase_report`  AS  select `product_purchase`.`purchase_date` AS `purchase_date`,`product_purchase`.`chalan_no` AS `chalan_no`,`product_purchase`.`supplier_id` AS `supplier_id`,`product_purchase_details`.`purchase_detail_id` AS `purchase_detail_id`,`product_purchase_details`.`purchase_id` AS `purchase_id`,`product_purchase_details`.`product_id` AS `product_id`,`product_purchase_details`.`quantity` AS `quantity`,`product_purchase_details`.`rate` AS `rate`,`product_purchase_details`.`total_amount` AS `total_amount`,`product_purchase_details`.`status` AS `status` from (`product_purchase_details` left join `product_purchase` on((`product_purchase_details`.`purchase_id` = `product_purchase`.`purchase_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `sales_actual`
--
DROP TABLE IF EXISTS `sales_actual`;

CREATE VIEW `sales_actual`  AS  select `sales_report`.`date` AS `DATE`,`sales_report`.`supplier_id` AS `supplier_id`,sum((`sales_report`.`quantity` * -(`sales_report`.`supplier_rate`))) AS `sub_total`,sum(`sales_report`.`cartoon`) AS `no_transection` from `sales_report` group by `sales_report`.`date`,`sales_report`.`supplier_id` union all select `supplier_ledger`.`date` AS `date`,`supplier_ledger`.`supplier_id` AS `supplier_id`,`supplier_ledger`.`amount` AS `sub_total`,`supplier_ledger`.`description` AS `no_transection` from `supplier_ledger` where isnull(`supplier_ledger`.`chalan_no`) group by `supplier_ledger`.`date`,`supplier_ledger`.`description`,`supplier_ledger`.`supplier_id` ;

-- --------------------------------------------------------

--
-- Structure for view `sales_report`
--
DROP TABLE IF EXISTS `sales_report`;

CREATE VIEW `sales_report`  AS  select `b`.`date` AS `date`,`b`.`invoice_id` AS `invoice_id`,`a`.`invoice_details_id` AS `invoice_details_id`,`b`.`customer_id` AS `customer_id`,`c`.`supplier_id` AS `supplier_id`,`a`.`product_id` AS `product_id`,`c`.`product_model` AS `product_model`,`c`.`product_name` AS `product_name`,`a`.`cartoon` AS `cartoon`,`a`.`quantity` AS `quantity`,`a`.`rate` AS `sell_rate`,`a`.`supplier_rate` AS `supplier_rate` from ((`invoice_details` `a` join `invoice` `b`) join `product_supplier` `c`) where ((`a`.`invoice_id` = `b`.`invoice_id`) and (`a`.`product_id` = `c`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `stock_history`
--
DROP TABLE IF EXISTS `stock_history`;

CREATE VIEW `stock_history`  AS  select `invoice`.`date` AS `vdate`,`invoice_details`.`product_id` AS `product_id`,sum(`invoice_details`.`quantity`) AS `sell`,0 AS `Purchase` from (`invoice_details` join `invoice` on((`invoice_details`.`invoice_id` = `invoice`.`invoice_id`))) group by `invoice_details`.`product_id`,`invoice`.`date` union select `product_purchase`.`purchase_date` AS `purchase_date`,`product_purchase_details`.`product_id` AS `product_id`,0 AS `0`,sum(`product_purchase_details`.`quantity`) AS `purchase` from (`product_purchase_details` join `product_purchase` on((`product_purchase_details`.`purchase_id` = `product_purchase`.`purchase_id`))) group by `product_purchase_details`.`product_id`,`product_purchase`.`purchase_date` ;

-- --------------------------------------------------------

--
-- Structure for view `view_customer_transection`
--
DROP TABLE IF EXISTS `view_customer_transection`;

CREATE VIEW `view_customer_transection`  AS  (select `i`.`transaction_id` AS `transaction_id`,`j`.`customer_name` AS `customer_name`,`q`.`invoice_no` AS `invoice_no`,`q`.`receipt_no` AS `receipt_no` from ((`transection` `i` left join `customer_information` `j` on((convert(`i`.`relation_id` using utf8) = `j`.`customer_id`))) left join `customer_ledger` `q` on((convert(`i`.`transaction_id` using utf8) = `q`.`transaction_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_person_transection`
--
DROP TABLE IF EXISTS `view_person_transection`;

CREATE VIEW `view_person_transection`  AS  (select `i`.`transaction_id` AS `transaction_id`,`j`.`person_name` AS `person_name` from (`transection` `i` left join `person_information` `j` on((convert(`i`.`relation_id` using utf8) = `j`.`person_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_supplier_transection`
--
DROP TABLE IF EXISTS `view_supplier_transection`;

CREATE VIEW `view_supplier_transection`  AS  (select `i`.`transaction_id` AS `transaction_id`,`j`.`supplier_name` AS `supplier_name` from (`transection` `i` left join `supplier_information` `j` on((convert(`i`.`relation_id` using utf8) = `j`.`supplier_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_transection`
--
DROP TABLE IF EXISTS `view_transection`;

CREATE VIEW `view_transection`  AS  (select `i`.`transaction_id` AS `transaction_id`,`i`.`date_of_transection` AS `date_of_transection`,`i`.`amount` AS `amount`,`i`.`pay_amount` AS `pay_amount`,`f`.`invoice_no` AS `invoice_no`,`g`.`customer_name` AS `customer_name`,`h`.`supplier_name` AS `supplier_name`,`j`.`person_name` AS `person_name`,`i`.`transection_category` AS `transection_category`,`i`.`transection_type` AS `transection_type`,`i`.`transection_mood` AS `transection_mood`,`i`.`description` AS `description`,`i`.`relation_id` AS `relation_id` from ((((`transection` `i` left join `customer_ledger` `f` on((convert(`i`.`transaction_id` using utf8) = `f`.`transaction_id`))) left join `customer_information` `g` on((convert(`i`.`relation_id` using utf8) = `f`.`customer_id`))) left join `supplier_information` `h` on((convert(`i`.`relation_id` using utf8) = `h`.`supplier_id`))) left join `person_information` `j` on((convert(`i`.`relation_id` using utf8) = `j`.`person_id`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_2`
--
ALTER TABLE `account_2`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `cheque_manger`
--
ALTER TABLE `cheque_manger`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `customer_information`
--
ALTER TABLE `customer_information`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_ledger`
--
ALTER TABLE `customer_ledger`
  ADD KEY `receipt_no` (`receipt_no`),
  ADD KEY `receipt_no_2` (`receipt_no`),
  ADD KEY `receipt_no_3` (`receipt_no`),
  ADD KEY `receipt_no_4` (`receipt_no`);

--
-- Indexes for table `daily_closing`
--
ALTER TABLE `daily_closing`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `head_office_deposit`
--
ALTER TABLE `head_office_deposit`
  ADD PRIMARY KEY (`transection_id`);

--
-- Indexes for table `inflow_92mizdldrv`
--
ALTER TABLE `inflow_92mizdldrv`
  ADD PRIMARY KEY (`transection_id`);

--
-- Indexes for table `inflow_yh5i8w9oea`
--
ALTER TABLE `inflow_yh5i8w9oea`
  ADD PRIMARY KEY (`transection_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_details_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `outflow_pt3vxiow9x`
--
ALTER TABLE `outflow_pt3vxiow9x`
  ADD PRIMARY KEY (`transection_id`);

--
-- Indexes for table `personal_loan`
--
ALTER TABLE `personal_loan`
  ADD PRIMARY KEY (`per_loan_id`);

--
-- Indexes for table `product_information`
--
ALTER TABLE `product_information`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_model` (`product_model`),
  ADD UNIQUE KEY `product_model_2` (`product_model`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `supplier_information`
--
ALTER TABLE `supplier_information`
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `supplier_ledger`
--
ALTER TABLE `supplier_ledger`
  ADD KEY `receipt_no` (`deposit_no`),
  ADD KEY `receipt_no_2` (`deposit_no`),
  ADD KEY `receipt_no_3` (`deposit_no`),
  ADD KEY `receipt_no_4` (`deposit_no`);

--
-- Indexes for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_information`
--
ALTER TABLE `tax_information`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `web_setting`
--
ALTER TABLE `web_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_2`
--
ALTER TABLE `account_2`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_loan`
--
ALTER TABLE `personal_loan`
  MODIFY `per_loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;