--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5 (Debian 17.5-1.pgdg120+1)
-- Dumped by pg_dump version 17.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: habit_completions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.habit_completions (
    id integer NOT NULL,
    habit_id integer NOT NULL,
    user_id integer NOT NULL,
    date date NOT NULL
);


--
-- Name: habit_completions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.habit_completions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: habit_completions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.habit_completions_id_seq OWNED BY public.habit_completions.id;


--
-- Name: habits; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.habits (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(255) NOT NULL,
    question text,
    frequency character varying(10) DEFAULT 'daily'::character varying,
    note text,
    target integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT habits_frequency_check CHECK (((frequency)::text = ANY ((ARRAY['daily'::character varying, 'weekly'::character varying])::text[])))
);


--
-- Name: habits_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.habits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: habits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.habits_id_seq OWNED BY public.habits.id;


--
-- Name: notes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.notes (
    id integer NOT NULL,
    user_id integer,
    content text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: notes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.notes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: notes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.notes_id_seq OWNED BY public.notes.id;


--
-- Name: todos; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.todos (
    id integer NOT NULL,
    user_id integer NOT NULL,
    content text NOT NULL,
    is_done boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: todos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.todos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: todos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.todos_id_seq OWNED BY public.todos.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password text NOT NULL,
    name character varying(100),
    surname character varying(100),
    role character varying(20) DEFAULT 'user'::character varying
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: habit_completions id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habit_completions ALTER COLUMN id SET DEFAULT nextval('public.habit_completions_id_seq'::regclass);


--
-- Name: habits id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habits ALTER COLUMN id SET DEFAULT nextval('public.habits_id_seq'::regclass);


--
-- Name: notes id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notes ALTER COLUMN id SET DEFAULT nextval('public.notes_id_seq'::regclass);


--
-- Name: todos id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.todos ALTER COLUMN id SET DEFAULT nextval('public.todos_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: habit_completions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.habit_completions (id, habit_id, user_id, date) FROM stdin;
92	15	5	2025-04-20
93	15	5	2025-04-12
94	15	5	2025-04-17
95	15	5	2025-03-18
96	15	5	2025-02-19
97	15	5	2025-01-21
98	16	5	2025-02-04
99	16	5	2025-05-19
100	16	5	2025-06-09
104	16	5	2025-03-11
105	16	5	2025-03-12
106	16	5	2025-03-13
107	16	5	2025-03-14
108	18	6	2025-02-17
109	18	6	2025-02-19
110	18	6	2025-02-13
111	18	6	2025-02-11
112	18	6	2025-05-18
113	18	6	2025-05-17
114	18	6	2025-05-16
115	18	6	2025-05-15
116	18	6	2025-05-08
117	18	6	2025-05-09
118	18	6	2025-05-10
119	18	6	2025-05-11
120	18	6	2025-05-12
121	18	6	2025-05-13
122	18	6	2025-05-14
123	18	6	2025-05-07
124	18	6	2025-05-06
125	18	6	2025-05-05
126	18	6	2025-05-04
127	18	6	2025-05-03
128	18	6	2025-05-02
129	18	6	2025-05-01
130	18	6	2025-04-15
131	18	6	2025-04-16
132	18	6	2025-04-17
133	18	6	2025-04-18
134	18	6	2025-04-19
135	18	6	2025-04-20
136	18	6	2025-04-21
137	18	6	2025-01-19
138	18	6	2025-01-24
139	18	6	2025-01-09
140	18	6	2025-01-03
141	18	6	2025-01-13
142	21	5	2025-01-01
143	21	5	2025-01-02
144	21	5	2025-01-03
145	21	5	2025-01-04
146	21	5	2025-01-05
147	21	5	2025-01-06
148	21	5	2025-01-07
149	21	5	2025-01-09
150	21	5	2025-01-10
151	21	5	2025-01-11
152	21	5	2025-01-12
153	21	5	2025-01-18
154	21	5	2025-01-24
155	21	5	2025-01-23
156	21	5	2025-01-30
157	21	5	2025-01-28
158	21	5	2025-01-27
159	21	5	2025-01-21
160	21	5	2025-02-24
161	21	5	2025-02-26
162	21	5	2025-02-03
163	21	5	2025-02-16
164	21	5	2025-02-19
165	21	5	2025-02-17
166	21	5	2025-04-01
167	21	5	2025-04-02
168	21	5	2025-04-03
169	21	5	2025-04-04
170	21	5	2025-04-05
171	21	5	2025-04-06
172	21	5	2025-04-07
173	21	5	2025-04-14
174	21	5	2025-04-13
175	21	5	2025-04-12
176	21	5	2025-04-10
177	21	5	2025-04-11
178	21	5	2025-04-09
179	21	5	2025-04-08
180	21	5	2025-04-15
181	21	5	2025-04-16
182	21	5	2025-04-17
183	21	5	2025-04-18
184	21	5	2025-04-19
185	21	5	2025-04-20
186	21	5	2025-04-21
187	21	5	2025-04-28
188	21	5	2025-04-27
189	21	5	2025-04-26
190	21	5	2025-04-24
191	21	5	2025-04-25
192	21	5	2025-04-23
193	21	5	2025-04-22
194	21	5	2025-04-29
195	21	5	2025-04-30
196	21	5	2025-03-28
197	21	5	2025-03-27
198	21	5	2025-03-26
199	21	5	2025-03-25
200	21	5	2025-03-24
201	21	5	2025-03-23
202	21	5	2025-03-22
203	21	5	2025-03-29
204	21	5	2025-03-30
205	21	5	2025-03-31
206	21	5	2025-03-15
207	21	5	2025-03-16
208	21	5	2025-03-17
209	21	5	2025-03-18
210	21	5	2025-03-19
211	21	5	2025-03-20
212	21	5	2025-03-21
213	21	5	2025-03-14
214	21	5	2025-03-12
215	21	5	2025-03-13
216	21	5	2025-03-11
217	21	5	2025-03-10
218	21	5	2025-03-09
219	21	5	2025-03-08
220	21	5	2025-03-01
221	21	5	2025-03-02
222	21	5	2025-03-03
223	21	5	2025-03-04
224	21	5	2025-03-05
225	21	5	2025-03-06
226	21	5	2025-03-07
227	21	5	2025-02-07
228	21	5	2025-02-06
229	21	5	2025-02-05
230	21	5	2025-02-04
231	21	5	2025-02-02
232	21	5	2025-02-01
233	21	5	2025-02-08
234	21	5	2025-02-09
235	21	5	2025-02-10
236	21	5	2025-02-11
237	21	5	2025-02-12
238	21	5	2025-02-13
239	21	5	2025-02-14
240	21	5	2025-02-21
241	21	5	2025-02-20
242	21	5	2025-02-27
243	21	5	2025-02-28
244	21	5	2025-02-25
245	21	5	2025-02-18
246	21	5	2025-02-23
247	21	5	2025-02-22
248	21	5	2025-02-15
249	21	5	2025-01-26
250	21	5	2025-01-25
251	21	5	2025-01-31
252	21	5	2025-01-29
253	21	5	2025-01-22
254	21	5	2025-01-15
255	21	5	2025-01-08
256	21	5	2025-01-16
257	21	5	2025-01-17
258	21	5	2025-01-19
259	21	5	2025-01-20
260	21	5	2025-01-13
261	21	5	2025-01-14
262	21	5	2025-05-01
263	21	5	2025-05-02
264	21	5	2025-05-03
265	21	5	2025-05-04
267	21	5	2025-05-06
268	21	5	2025-05-05
274	15	5	2025-04-11
275	22	7	2025-01-02
276	22	7	2025-01-17
277	22	7	2025-01-19
278	22	7	2025-01-12
279	22	7	2025-01-21
280	22	7	2025-01-27
281	22	7	2025-01-13
282	22	7	2025-04-17
283	22	7	2025-04-11
284	22	7	2025-04-19
285	22	7	2025-04-25
286	22	7	2025-04-08
287	22	7	2025-03-19
288	22	7	2025-03-23
289	22	7	2025-03-10
290	22	7	2025-03-12
291	22	7	2025-03-24
292	22	7	2025-03-18
293	22	7	2025-03-16
294	22	7	2025-02-11
295	22	7	2025-02-24
296	22	7	2025-02-09
297	22	7	2025-02-27
298	22	7	2025-02-13
299	22	7	2025-02-25
303	22	7	2025-05-18
304	22	7	2025-05-14
305	22	7	2025-05-11
306	22	7	2025-02-03
307	22	7	2025-02-04
308	22	7	2025-03-27
309	22	7	2025-03-14
\.


--
-- Data for Name: habits; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.habits (id, user_id, name, question, frequency, note, target, created_at) FROM stdin;
15	5	xxxx	xxxx	daily	xxx	\N	2025-04-28 20:48:45.901023
16	5	aaaa	aaaa	daily	aaaa	\N	2025-04-28 20:48:52.365938
18	6	running	Did you run 10km today?	daily	at least 10km per day	10	2025-04-29 22:35:14.769177
19	6	aaaa	asa	daily	asaba	\N	2025-04-29 22:50:17.704431
20	6	cccc	ddddddd	daily	eeeee	12	2025-04-29 22:50:30.541673
21	5	srałes	czy srałes	daily	srtanie w ciagu dnia	\N	2025-05-06 22:23:53.387912
22	7	Bieganie	sanghakljsgn	daily	asgagasg	\N	2025-05-19 22:15:25.434326
\.


--
-- Data for Name: notes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.notes (id, user_id, content, created_at) FROM stdin;
\.


--
-- Data for Name: todos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.todos (id, user_id, content, is_done, created_at) FROM stdin;
35	5	asgagags	f	2025-04-28 20:49:03.074722
36	5	asfasfa	f	2025-04-28 20:49:04.878534
37	5	shopping	f	2025-04-29 19:46:53.841731
38	5	3 eggs	f	2025-04-29 19:46:58.378032
39	6	buy and kill fish	f	2025-04-29 22:35:39.238434
40	6	asagasg	t	2025-04-29 22:43:05.429915
43	7	ahsgahghasgjhasgjklahsgl	t	2025-05-19 22:14:24.534612
44	7	sgasgmasg;klasgs	f	2025-05-19 22:14:27.404695
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, email, password, name, surname, role) FROM stdin;
2	adm@test.com	$2y$10$/GXHbUX73363yImUj5DPjOOBgkqJyB/EKTfQHPKCxYr/B7kg.Py6.	\N	\N	admin
6	pk2@test.com	$2y$10$EJUJbBc4hLkpfOLO/AQ47u6ijGpaBcWlE/zEeRFQKQrYucf935jqG	Piter	Parker	user
7	dupa@dupa.com	$2y$10$6Urbx6kD6AuHzErf1J5VMu25cT3t0KTasOcRlvB8AXPHPDG6u9Yla	\N	\N	user
5	pk@test.com	$2y$10$h7RLGKWmM/uQaJ6kNR6xGe7AtXue3HcDVsGcWx27ibTQrAQqt/Hx6	\N	\N	user
\.


--
-- Name: habit_completions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.habit_completions_id_seq', 309, true);


--
-- Name: habits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.habits_id_seq', 23, true);


--
-- Name: notes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.notes_id_seq', 1, false);


--
-- Name: todos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.todos_id_seq', 44, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 7, true);


--
-- Name: habit_completions habit_completions_habit_id_user_id_date_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habit_completions
    ADD CONSTRAINT habit_completions_habit_id_user_id_date_key UNIQUE (habit_id, user_id, date);


--
-- Name: habit_completions habit_completions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habit_completions
    ADD CONSTRAINT habit_completions_pkey PRIMARY KEY (id);


--
-- Name: habits habits_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habits
    ADD CONSTRAINT habits_pkey PRIMARY KEY (id);


--
-- Name: notes notes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notes
    ADD CONSTRAINT notes_pkey PRIMARY KEY (id);


--
-- Name: todos todos_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.todos
    ADD CONSTRAINT todos_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: habit_completions habit_completions_habit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habit_completions
    ADD CONSTRAINT habit_completions_habit_id_fkey FOREIGN KEY (habit_id) REFERENCES public.habits(id) ON DELETE CASCADE;


--
-- Name: habit_completions habit_completions_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habit_completions
    ADD CONSTRAINT habit_completions_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: habits habits_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.habits
    ADD CONSTRAINT habits_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: notes notes_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notes
    ADD CONSTRAINT notes_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: todos todos_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.todos
    ADD CONSTRAINT todos_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--
