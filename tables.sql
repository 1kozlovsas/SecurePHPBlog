SET TIME ZONE 'UTC';

--
-- Table structure for table users
--

CREATE TABLE IF NOT EXISTS users (
  id SERIAL,
  username text NOT NULL UNIQUE,
  email text NOT NULL,
  password text NOT NULL,
  name text NOT NULL,
  created text NOT NULL,
  attempt text NOT NULL DEFAULT '0',
  profile text,
  avatar text,
  role text,
  PRIMARY KEY (id)
);

--
-- Table structure for table user_tokens
--

CREATE TABLE IF NOT EXISTS user_tokens (
  token text NOT NULL, -- 'The Unique Token Generated'
  uid integer NOT NULL, -- 'The User Id'
  requested text NOT NULL -- 'The Date when token was created'
);

--
-- Table structure for table user_devices
--

CREATE TABLE IF NOT EXISTS user_devices (
  id SERIAL,
  uid int NOT NULL, -- The user's ID
  token character(15) NOT NULL, -- A unique token for the user's device
  last_access text NOT NULL,
  PRIMARY KEY (id)
);

--
-- Table structure for table posts
--

CREATE TABLE IF NOT EXISTS posts (
  id SERIAL,
  username text NOT NULL references users(username),
  body text NOT NULL,
  created text NOT NULL,
  PRIMARY KEY (id)
);