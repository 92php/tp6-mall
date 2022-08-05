
--redis 连接池设置--
local function close_redis(red)
    if not red then
        return
    end
    local pool_max_idle_time = 10000
    local pool_size = 500
    local ok, err = red:set_keepalive(pool_max_idle_time,pool_size)
    local log = ngx_log
    if not ok then
        log(ngx_ERR, "set redis keepalive error : ",err)
    end
end

--连接redis--
local redis = require('resty.redis')
local red = redis.new()
red:set_timeout(1000)     --连接redis超时时间--
local ip = "127.0.0.1"
local port = "6379"

local ok, err = red:connect(ip,port)

if not ok then
    ngx.log(ngx.ERR,"redis_conn_status:",ok)
    ngx.log(ngx.ERR,"redis_conn_err:",err)
else
    -- // 业务逻辑处理 todo
end

